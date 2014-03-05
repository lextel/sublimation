<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}


class UserTableSeeder extends Seeder {
 
  public function run() {
    User::create(array(
      'username' => 'admin',
      'password' => Hash::make('1234567'),   // 生成密码.
      'email' => 'zhouitpro@gmail.com'
    ));
  }
 
}
