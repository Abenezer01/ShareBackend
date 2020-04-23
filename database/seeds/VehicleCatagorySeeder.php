<?php

use App\VehicleCatagory;
use Illuminate\Database\Seeder;

class VehicleCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $vehicleCatagory = [
        [
          'VehicleCatagoryID' => uniqid('VT-'),
          'name' => 'Pickup',
          'description' => 'A pickup truck or pickup is a light-duty truck having an enclosed cab and an open cargo area with low sides
                             and tailgate.In Australia and New Zealand, both pickups and coupé utilities are called utes, short for utility vehicle.'
        ],
        [
          'VehicleCatagoryID' => uniqid('VT-'),
          'name' => 'Van',
          'description' => 'A van is a type of road vehicle used for transporting goods or people.
                             Depending on the type of van, it can be bigger or smaller than a truck and SUV,
                             and bigger than a common car. There is some varying in the scope of the word across
                             the different English-speaking countries'
        ],
        [
          'VehicleCatagoryID' => uniqid('VT-'),
          'name' => 'MidSize',
          'description' => 'A mid-size car— also known as intermediate— is a vehicle size class which originated in the United States and is used for cars
                              that are larger than compact cars, but smaller than full-size cars. The equivalent European category is D-segment, which is also
                              called "large family car"'
        ],

      ];
      foreach ($vehicleCatagory as $vehicleCatagory) {
        VehicleCatagory::create($vehicleCatagory);
      }
    }

}
