<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

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
            'name' => 'Bella Aresta',
            'email' => 'bellaresta@students.uajy.ac.id',
            'password' => '$2a$12$Qyqb3y0UDoFGoEzcjKF1LOH/gDiAizt1JFkMGKpeOhrYrJWYDxSHq',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
