<?php

use Illuminate\Database\Seeder;
use Vialoja\Entities\Gender as s;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        s::truncate();
        s::create(['name' => 'Masculino']);
        s::create(['name' => 'Feminino']);
        s::create(['name' => 'Indefinido']);
    }
}
