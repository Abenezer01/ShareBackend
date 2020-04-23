<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
  protected $guarded=[];
  protected $primaryKey = "id";
  public $incrementing = false;
  protected $fillable = [
      'id', 'itemsGroupId', 'availability', 'name', 'price', 'description', 'serviceProviderId',
  ];
  public function serviceProvider()
  {
      return $this->belongsTo('App\CHRLServiceProviders', 'serviceProviderId', 'serviceProviderId');
  }
  public function itemsGroup()
  {
      return $this->belongsTo('App\MenuItemGroup', 'itemsGroupId', 'itemsGroupId');
  }
  public function picture(){
    return $this->morphMany(Image::class,'imageable');
  }
}
