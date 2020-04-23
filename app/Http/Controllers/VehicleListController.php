<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleListController extends Controller
{
    public function getVehicleData(){
      $path = 'data/vehicle-list.json';
      $content = json_decode(file_get_contents($path), true);
      return response()->json($content,200);
    }
}
