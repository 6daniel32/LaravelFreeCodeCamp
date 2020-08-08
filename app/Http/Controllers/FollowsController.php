<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller {
    
    //para que cuando alguien haga click en follow, si no está autenticado en vez de 
    //que la petición entre al server y salte un error 500, salte un error 401 (unauthorized) y
    //al cliente le salte por el catch para que pueda gestionarlo
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(User $user) {
        return auth()->user()->following()->toggle($user->profile);
    }

}
