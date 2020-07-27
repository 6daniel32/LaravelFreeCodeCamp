<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        //equivalente a posts/create (para marcar que es una blade dentro de un directorio). 
        //se puede usar tanto la barra como el punto.
        return view('posts.create');
    }

    public function store() {
        //'another' => '' notation makes that if another field different of the expected ones, 
        //transforms it into an empty string
        $data = request()->validate([
            'another' => '',
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);
        
        $data['user_id'] = auth()->user();

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }
}
