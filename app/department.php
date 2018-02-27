<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $table = 'department';
    public $timestamps = false;
    protected $primaryKey = 'MITS';
    protected $fillable = ['MITS','Department','Emp_Fname','Emp_Lname','Date_Of_Received','MRS'];
}
