<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 19;
        $name = [
            'Jose Luis Sicajan Coy',
            'Fabian Sicajan Coy',
            'Edvin Leonel Upun Tzirin',
            'Juan Carlos Tocoche Teleguario',
            'Isabel Ixen Queche',
            'Oseas Tomin Sanum',
            'Byron Francisco Xico Ajsac',
            'Miriam Elizabeth Sicajan Sir',
            'Zoila Johana Marroquin Jochola',
            'Sandra Leticia Upun Tzirin',
            'Rodrigo Lopez Lucas',
            'Narciso Raquec Mutzutz',
            'Josefina Queche',
            'Pascual Catu Aju',
            'Kimberly Ramirez Upun',
            'Faustino Sicajan',
            'David Marroquin Jochola',
            'Rosendo Tzay Batz',
            'Osman Catu',
            'Reina Catu Raquec'
        ];
        $username = [
            'admin@sicajan.com',
            'fabian',
            'edvin',
            'juan',
            'isabel',
            'oseas',
            'byron',
            'miriam',
            'zoila',
            'sandra',
            'rodrigo',
            'narciso',
            'josefina',
            'pascual',
            'kimberly',
            'faustino',
            'david',
            'rosendo',
            'osman',
            'reina',
        ];
        $number = [
            '3128',
            '0415',
            '1059',
            '0768',
            '0430',
            '1057',
            '2819',
            '2100',
            '2110',
            '1489',
            '2104',
            '1056',
            '1489',
            '0405',
            '0000',
            '0000',
            '1490',
            '0406',
            '0000',
            '1111',
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'username' => $username[$i],
                'number' => $number[$i],
                'password' => 'null',
                'email' => $username[$i]
            ]);
        }
    }
}
