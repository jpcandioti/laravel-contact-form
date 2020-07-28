<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            ['description' => 'Reclamo'],
            ['description' => 'Solicitud'],
            ['description' => 'Queja']
        ]);
    }
}
