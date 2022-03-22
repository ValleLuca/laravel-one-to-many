<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        // one to many
        return $this->hasMany('App\post');
    }
}