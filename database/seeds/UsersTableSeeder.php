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
        DB::table('users')->insert([
            'firstname' => 'Opeyemi',
            'lastname' => 'Adeyeye',
            'email' => 'opeyemiadeyeyesimeon@gmail.com',
            'phone' => '08065612206',
            'role_id' => 1,
            'password' => bcrypt('admin0001'),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'firstname' => 'Femi',
            'lastname' => 'Taiwo',
            'email' => 'femitaiwo@initsng.com',
            'phone' => '08023909799',
            'role_id' => 1,
            'password' => bcrypt('admin0001'),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);        
    }
}
