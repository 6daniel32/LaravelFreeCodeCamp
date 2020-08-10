<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2);
        return view('posts.index', compact('posts'));
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

        //image local storage
        $imagePath = request('image')->store('uploads', 'public');
        //image resizing and saving
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        //post and image path BBDD storage
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }
    
    //poniendo esa ruta delante de la variable, se hace que en lugar de recibir el id del post
    //(lo que se revibiría teniendo como argumento $post solo), se reciba el objeto entero
    //desde la base de datos (laravel hace la consulta a la BBDD automaticamente)
    public function show(\App\Post $post){
        //la funcion compact hace lo mismo que pasar a la vista el array de parámetros
        return view('posts.show', compact('post'));
    }
}
