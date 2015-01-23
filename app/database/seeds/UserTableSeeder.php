<?php

class UserTableSeeder extends Seeder {

  /**
   * Seeds the users table.
   */
  public function run() {
    // admin@dosomething.org
    User::create(['_id' => '54c28b607e7bc2667e8b4588'])->assignRole(1);
  }
}
