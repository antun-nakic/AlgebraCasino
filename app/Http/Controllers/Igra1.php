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


        return view('igra1')->with(['naslov' => 'Igra tri boje', 'boje' => $odabraneBoje, 'pobjeda' => $pobjeda, 'brojTokena' => $mojKorisnik->coins]);
    }

    public function statistics()
    {
        echo '<ul>';
        foreach (Game::find(1)->statistika_igre as $zapis) {
            echo '<li>' . User::find($zapis->idKorisnika)->name . ' - dobitak: ' . $zapis->dobitak . '</li>';
        }
        echo '</ul>';
    }
}
