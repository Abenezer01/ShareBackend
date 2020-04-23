<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
  protected $primaryKey = "userTypeId";
  public $incrementing = false;
  protected $fillable = [
    'userTypeId', 'name'
  ];
  public function user()
  {
    return $this->belongsTo('App\UserType', 'userTypeId', 'userTypeId');
  }
}
