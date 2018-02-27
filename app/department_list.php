<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department_list extends Model
{
      protected $table = 'department_list';
      public $timestamps = false;
      protected $primaryKey = 'Department';
       protected $fillable = ['Department','Dept_Code'];

}
