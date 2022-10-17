<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'Admin',
               'email'=>'rahmanmoshiur253@gmail.com',
               'image'=>'https://images.pexels.com/photos/2413089/pexels-photo-2413089.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'is_admin'=>'1',
                'img_name'=>'pexels-photo-2413089.jpeg',
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Regular User',
               'email'=>'user@gmail.com',
               'image'=>'https://images.pexels.com/photos/1615842/pexels-photo-1615842.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'is_admin'=>'0',
                'img_name'=>'pexels-photo-1615842.jpeg',
               'password'=> bcrypt('1234'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
