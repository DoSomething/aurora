<?php

class RolesTableSeeder extends Seeder {

  /**
   * Seeds the roles table.
   */
  public function run()
  {
    Role::truncate();
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'staff']);
    Role::create(['name' => 'intern']);
  }
}
