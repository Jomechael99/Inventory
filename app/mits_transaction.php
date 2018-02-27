<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mits_transaction extends Model
{
    protected $table = 'mits_transaction';
    public $timestamps = false;
    protected $primaryKey = 'TransNo';
    protected $fillable = ['TransNo','MITS','OUM','QTY','Product_Code','Remarks','ProductNo'];
}
