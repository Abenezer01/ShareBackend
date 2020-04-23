<?php

use Illuminate\Database\Seeder;
use App\UserType;
class CreateUserType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      UserType::create([
        'name' => 'Super Admin',
        'userTypeId'=>uniqid('UT-')
      ]);
      UserType::create([
        'name' => 'Sub Admin',
        'userTypeId'=>uniqid('UT-')
      ]);
    }
}
