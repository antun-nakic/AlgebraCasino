<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AllGames;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class Igra1 extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        //primiti podatke iz forme
        $ulog = $request->get("ulog");
        //provjera dali je pobijedio
        $boje = array('blue', 'red', 'yellow');
        $odabraneBoje = array($boje[rand(0, 2)], $boje[rand(0, 2)], $boje[rand(0, 2)]);
        if ($odabraneBoje[0] == $odabraneBoje[1] && $odabraneBoje[2] == $odabraneBoje[1]) {
            $pobjeda = true;
            $mojKorisnik = User::find(Auth::user()->id);
            //$mojKorisnik = Auth::user();
            $mojKorisnik->coins = $mojKorisnik->coins + $ulog * 9;
            $mojKorisnik->update();
        } else {
            $pobjeda = FALSE;
            $mojKorisnik = Auth::user();
            $mojKorisnik->coins = $mojKorisnik->coins - $ulog;
            $mojKorisnik->update();
        }

        $zapisUstatistiku = new AllGames();
        $zapisUstatistiku->idKorisnika = Auth::user()->id;
        $zapisUstatistiku->idIgre = 1;
        $zapisUstatistiku->dobitak = $pobjeda ? $ulog * 8 : (-$ulog);
        $zapisUstatistiku->save();

        //oduzmi coinse ili dodaj u bazi podataka od korisnika


        return view('Igra1.index')->with(['naslov' => 'Igra tri boje', 'boje' => $odabraneBoje, 'pobjeda' => $pobjeda, 'brojTokena' => $mojKorisnik->coins]);
    }

    public function statistics()
    {
        /*
        echo '<ul>';
        foreach (Game::find(1)->statistika_igre->where('dobitak', '<', 0)->sortBy('dobitak')->slice(0, 5)->put('name', AllGames::all()->pripada_korisniku)
            ->pluck('name', 'dobitak')->all() as $korisnik => $dobitak) {
            echo '<li>' . $dobitak . ' - ' . $korisnik . '</li>';
        }
        echo '</ul>';
        */

        $sortD = Game::find(1)->statistika_igre->where('dobitak', '>', 0)->sortByDesc('dobitak')
            ->pluck('idKorisnika', 'dobitak')->slice(0, 5)->all();

        AllGames::find(1)->pripada_korisniku->first()['name'];
        $sortG = Game::find(1)->statistika_igre->where('dobitak', '<', 0)->sortBy('dobitak')
            ->pluck('idKorisnika', 'dobitak')->slice(0, 5)->all();
        return view('Igra1.statistika')->with(['naslov' => 'Igra tri boje', 'sortD' => $sortD, 'sortG' => $sortG]);
    }
}
