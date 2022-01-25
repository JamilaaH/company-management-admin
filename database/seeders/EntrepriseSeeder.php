<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entreprises')->insert([
            [
                "user_id" => 2,
                "nom"=>"Electro", 
                "activite"=>"électricité", 
                "ville"=>"Bruxelles", 
                "pays"=>"Belgique", 
                "code_postal"=>1000, 
                "email"=>"electro@gmail.com", 
                "nom_contact"=>"Lisa", 
                "numero_contact"=>484961542, 
            ],
            [
                "user_id" => 3,
                "nom"=>"Mecano SPRL", 
                "activite"=>"mécanique", 
                "ville"=>"Charleroi", 
                "pays"=>"Belgique", 
                "code_postal"=>6000, 
                "email"=>"mecano@gmail.com", 
                "nom_contact"=>"marc", 
                "numero_contact"=>465981577, 
            ],
        ]);
    }
}
