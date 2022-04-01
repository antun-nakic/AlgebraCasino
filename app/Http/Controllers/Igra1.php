<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Igra1 extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        //primiti podatke iz forme

        //provjera dali je pobijedio
        $boje = array('blue', 'red', 'yellow');
        $odabraneBoje = array($boje[rand(0, 2)], $boje[rand(0, 2)], $boje[rand(0, 2)]);
        if ($odabraneBoje[0] == $odabraneBoje[1] && $odabraneBoje[2] == $odabraneBoje[1]) $pobjeda = true;
        else $pobjeda = false;

        //oduzmi coinse ili dodaj u bazi podataka od korisnika

        return view('igra1')->with(['naslov' => 'Igra tri boje', 'boje' => $odabraneBoje, 'pobjeda' => $pobjeda]);
    }
}
