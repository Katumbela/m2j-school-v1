<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'name' => "João A. Katombela",
            'email' => 'katumbela@m2j.ao',
            'password' => bcrypt('secret'),
            'role' => 'master',
            'active' => 1,
            'verified' => 1,
        ]);
        //factory(App\User::class, 200)->create();
    }
}
