<?php

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
	DB::table('users')->delete();

        $password = Hash::make('password');

	DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
        ]);

    }
}
