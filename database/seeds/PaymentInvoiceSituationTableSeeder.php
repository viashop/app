<?php

use Illuminate\Database\Seeder;
use Vialoja\Entities\PaymentInvoiceSituation as s;

class PaymentInvoiceSituationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        s::truncate();
        s::create(['name' => 'Aguardando processamento...']);
        s::create(['name' => 'Pendente']);
        s::create(['name' => 'Cancelado']);
        s::create(['name' => 'Em suspenso']);
        s::create(['name' => 'Pago']);
    }
}
