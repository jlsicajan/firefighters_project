<?php

use Illuminate\Database\Seeder;

class NewUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 2;
        $name = [
            'Edson Aju Canu',
            'Azucena Cuxil',
        ];
        $username = [
            'edson',
            'azucena',
        ];
        $number = [
            //            0000 are brigade
            '2087',
            '2207',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'username' => $username[$i],
                'number' => $number[$i],
                'password' => bcrypt($number[$i]),
                'email' => $username[$i]
            ]);
        }
    }
}
