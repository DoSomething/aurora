<?php

class UserTableSeeder extends Seeder {

  /**
   * Seeds the users table.
   */
  public function run() {
    User::truncate();

    // Test user mongo id.
    User::create(['_id' => '5480c950bffebc651c8b456f']);
  }
}
