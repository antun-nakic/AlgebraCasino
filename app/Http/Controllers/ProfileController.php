<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function store(Request $request)
    {
        //file koji spremamo neka se zove po špranci
        //avatar_{id}.jpg
        //avatar_1.jpg

        $request->validate(['slikaProfila' => 'required|file|image']);
        $file = $request->file('slikaProfila');
        $realPath = $file->storeAs(
            'public/avatars',
            'avatar_' . $request->user()->id . '.' . $file->getClientOriginalExtension()
        );
        $onlinePath = 'storage/avatars/avatar_' . $request->user()->id . '.' . $file->getClientOriginalExtension();
        $user = Auth::user();
        $user->avatar_url = $onlinePath;
        $user->update();

        /*
        $filename = $_FILES['slikaProfila']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        Storage::disk('local')->put('public/avatar_' . Auth::user()->id . '.' . $ext, file_get_contents($request->slikaProfila));

        $user = Auth::user();
        $user->avatar_url = "storage/avatar_" . Auth::user()->id . '.' . $ext;
        $user->update();
        */

        return view('profile');
    }
}
