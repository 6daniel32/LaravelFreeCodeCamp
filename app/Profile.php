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
        $this->image : 'profile/W6rNzoj8jED5TiHPLgVw7QKfJ7LVskyH7udoXMhS.jpeg';
        return $imagePath;
    }
}
