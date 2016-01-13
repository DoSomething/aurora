<?php

class UserTableSeeder extends Seeder
{
    /**
   * Seeds the users table.
   */
  public function run()
  {
      // test@dosomething.org (Non-signed up user)
    // Using test@dosomething.org as Admin-user
    User::create(['_id' => '5430e850dt8hbc541c37tt3d'])->assignRole(1);
  }
}
