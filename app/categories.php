<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    public function posts(){
        // one to many
        return $this->hasMany('App\post');
    }
}