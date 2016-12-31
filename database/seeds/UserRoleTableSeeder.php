<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = 21;
        $user_id = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18,
            19, 20, 21,
        ];
        $role_id = [
//            ADMINISTRADOR => 1
//            PERMANENTE => 2
//            AD-HONOREM => 3
//            BRIGADISTA => 4
            1, // JOSE LUIS
            1, // FABIAN
            1, // EDVIN UPUN
            2, // JUAN TOCOCHE
            2, // ISABEL QUECHE
            2, // OSEAS TOMIN
            2, // BYRON XICO
            2, // MIRIAM ELIZABETH
            2, // ZOILA MARROQUIN
            2, // SANDRA LETICIA UPUN
            3, // RODRIGO LOPEZ
            1, // NARCISO RAQUEC
            3, // JOSEFINA RAQUEC
            3, // PASCUAL CATU
            4, // KIMBERLY UPUN
            3, // FAUSTINO SICAJAN
            3, // DAVID SULE MARROQUIN
            3, // ROSENDO TZAY BATZ             rol?
            4, // OSMAN CATU
            3, // REINA CATU
            3, // KATERIN CASTILLO
        ];
        for ($i = 0; $i < $quantity; $i++) {
            DB::table('user_roles')->insert([
                'role_id' => $role_id[$i],
                'user_id' => $user_id[$i],
            ]);
        }
    }
}
