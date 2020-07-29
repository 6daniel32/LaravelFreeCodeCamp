<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user) {

        return view('profiles.index', compact('user'));
    }

    //como tenemos importado "App\User", aqui escribimos solo "User"
    //en vez de "App\User" para que laravel nos busque automaticamente el user
    //en la BBDD y lo podamos usar en la función en vez de recibir un "id" y tener
    //que buscarlo nosotros con findOrFail()
    public function edit(User $user) {

        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ''
        ]);

        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }
}
