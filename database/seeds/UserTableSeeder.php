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
        DB::table('users')->insert([
            'name' => 'Administrador',
            'username' => 'admin',
            'number' => '2013124',
            'password' => bcrypt('235689/jlsc'),
            'email' => 'admin'
        ]);
        $quantity = 21;
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
            'Josefina Raquec',
            'Pascual Catu Aju',
            'Kimberly Ramirez Upun',
            'Faustino Sicajan',
            'David Sule Marroquin Jochola',
            'Rosendo Tzay Batz',
            'Osman Catu',
            'Reina Catu Raquec',
            'Katerin Castillo'
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
            'katerincastillo'
        ];
        $number = [
//            0000 are brigade
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
            '1811',
            '0405',
            '0000',
            '0000',
            '1490',
            '0406',
            '0000',
            '434',
            '2545'
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'username' => $username[$i],
                'number' => $number[$i],
                'password' => 'null',
                'email' => $name[$i]
            ]);
        }
    }
}
