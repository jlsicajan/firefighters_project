<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 4;
        $name = [
            'ADMINISTRADOR',
            'PERMANENTE',
            'AD-HONOREM',
            'BRIGADISTA',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('roles')->insert([
                'name'     => $name[$i],
            ]);
        }
    }
}
