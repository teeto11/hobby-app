<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Hobby extends Model
{
    use Notifiable;
    
    public $table = "hobby";

    protected $fillable = [
        'user_id', 'hobby', 
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
