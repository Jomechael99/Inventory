<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

  protected $table = 'product';
  public $timestamps = false;
  protected $primaryKey = 'ProductNo';
  protected $fillable = ['ProductNo','ProductName','Particular','Product_Code'];

}
