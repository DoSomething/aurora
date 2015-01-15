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
    $this->command->info('User table seeded');

    $this->call('RolesSeeder');
    $this->command->info('Roles table seeded');
  }

}
