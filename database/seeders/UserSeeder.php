<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "nom"=> "Jamila",
                "email"=>"jamila@gmail.com",
                "password"=>Hash::make('password'),
            ],
            [
                "nom"=> "entreprise1",
                "email"=>"entreprise1@gmail.com",
                "password"=>Hash::make('password'),
            ],
            [
                "nom"=> "Entreprise2",
                "email"=>"entreprise2@gmail.com",
                "password"=>Hash::make('password'),
            ],
        ]);
    }
}
