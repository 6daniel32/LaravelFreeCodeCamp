<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function profileImage() {
        $imagePath = ($this->image) ? 
        $this->image : 'profile/XMggdXy4Cyp8nAeScPoHOqckx4pFTJ5bfPBjLElH.jpeg';
        return $imagePath;
    }

    public function followers() {
        return $this->belongsToMany(User::class);
    }
}
