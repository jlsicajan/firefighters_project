<?php

use Illuminate\Database\Seeder;

class UnityTDP2202Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 1;
        $name = [
            'UNIDAD MDP-22-02',
        ];
        $code = [
            'MDP22-02',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('unities')->insert([
                'name' => $name[$i],
                'code' => $code[$i],
            ]);
        }
    }
}
