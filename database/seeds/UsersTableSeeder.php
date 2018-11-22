<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'snooker',
            'email' => 'ker13530018@gmail.com',
            'password' => bcrypt('sz09063012'),
        ]);
    }
}
