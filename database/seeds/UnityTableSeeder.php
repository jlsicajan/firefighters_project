<?php

use Illuminate\Database\Seeder;

class UnityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 5;
        $name = [
            'UNIDAD AD-21',
            'UNIDAD RD-19',
            'UNIDAD MDP-22',
            'UNIDAD TDP-22',
            'UNIDAD EE-22',
        ];
        $code = [
            'AD21',
            'RD19',
            'MDP22',
            'TDP22',
            'EE22',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('unities')->insert([
                'name' => $name[$i],
                'code' => $code[$i],
            ]);
        }
    }
}
