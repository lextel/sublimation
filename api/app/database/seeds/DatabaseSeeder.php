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
      'username' => '398667606@qq.com',
      'password' => Hash::make('1234567', ['method'=>'pbkdf2']),   // 生成密码.
      'email' => '398667606@qq.com',
      'nickname' => '舞动',
    ));
    var_dump(User::where('username', '=', 'admin')->first());
  }
 
}
