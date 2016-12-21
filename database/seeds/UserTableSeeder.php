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
    DB::table('users')->insert(
      array(
        'name' => 'Jose Luis Sicajan Coy',
        'username' => 'jlsicajan',
        'password' => bcrypt('NeZPJp8Wc'),
        'email' => 'admin@sicajan.com'
      )
    );
  }
}
