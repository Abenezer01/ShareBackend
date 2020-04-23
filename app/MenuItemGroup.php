<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItemGroup extends Model
{
  protected $guarded=[];
  protected $primaryKey = "id";
  public $incrementing = false;
  protected $fillable = [
      'id',  'name', 'description',
  ];
  public function menuItems()
  {
      return $this->hasMany('App\MenuItems', 'id', 'id');
  }
  public function images(){
    return $this->morphMany('App\Image', 'imageable');
  }
  public function getSelectedLogo(){
    return $this->images()->first();
  }
}
