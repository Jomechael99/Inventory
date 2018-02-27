<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admins extends Model
{
    protected $fillable = [
        'username', 'password','type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
    protected $table = 'admins';
    protected $primaryKey = 'id';
   

}
