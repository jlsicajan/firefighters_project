<?php

use Illuminate\Database\Seeder;

class NewElementsUserTableSeeder extends Seeder
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
            'Carlos David Sicajan Xicay',
            'Edward Mucia',
            'Edgar Upun',
            'Amarilis Ramirez',
        ];
        $username = [
            'carlos_sicajan',
            'edward_mucia',
            'edgar_upun',
            'amarilis_ramirez',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'username' => $username[$i],
                'number' => 0000,
                'password' => bcrypt("0000"),
                'email' => $username[$i]
            ]);
        }
    }
}
