<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
  		'name' => 'samuel',
        'email' => 'samuellopezrosales101@gmail.com',
        'password' => bcrypt('Barcelona1234'), // secret
        'dni' => '12345678',
        'address' => '',
        'phone' => '',
        'role' => 'admin'
    	]);
        factory(User::class, 50)->create();
    }
}
