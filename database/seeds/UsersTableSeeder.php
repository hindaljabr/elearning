<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        		'lastname' => 'Harris', 'firstname' => 'Peter', 
                'email' => 'peteharris401@gmail.com', 'password' => 'peteharris401', 
                'type' => User::ADMIN,
        	],
            [
                'lastname' => 'John', 'firstname' => 'Alex', 
                'email' => 'alexgomex@gmail.com', 'password' => 'alexgomex@gmail.com',
                'type' => User::USER,
            ],
        ];

        app('db')->table('users')->delete();

        $userModel = new User;
        foreach ( $users  as $u ) {
        	$userModel->create( $u );
        }
    }
}
