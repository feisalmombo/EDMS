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
    	DB::table('users')->delete();
    	User::create([
    		'name' => 'admin',
    		'email' => 'admin@gmail.com',
    		'password' =>bcrypt('123456789'),
            'lastname' => 'admin',
            'firstname' => 'mr',
    		'is_admin' => true,
    		]);
    	User::create([
    		'name' => 'company',
    		'email' => 'company@gmail.com',
    		'password' =>bcrypt('123456789'),
            'lastname' => 'company',
            'firstname' => 'mr',
    		'is_admin' => false,
    		]);
    	User::create([
    		'name' => 'student',
    		'email' => 'student@gmail.com',
    		'password' =>bcrypt('123456789'),
            'lastname' => 'student',
            'firstname' => 'mr',
    		'is_admin' => false,
    		]);
    }
}

