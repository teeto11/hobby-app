<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    public $table = "hobby";

    protected $fillable = [
        'user_id', 'hobby', 
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
