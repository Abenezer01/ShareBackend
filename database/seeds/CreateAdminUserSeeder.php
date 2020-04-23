<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { $user = User::create([
      'name' => 'Abenezer Seyoum',
      'id'=>uniqid('User-'),
      'email' => 'abenezerseyoum7@gmail.com',
      'phone'=>'0932588260',
      'userTypeId'=>UserType::first()->userTypeId,
      'password' => bcrypt('123456'),
    ]);
}
}
