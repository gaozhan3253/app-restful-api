<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => '827951152@qq.com',
            'password' => bcrypt('admin'),
            'status' => 1,
        ]);
    }
}
