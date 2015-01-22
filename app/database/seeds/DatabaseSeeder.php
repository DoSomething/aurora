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
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    $this->call('UserTableSeeder');
    $this->command->info('User table seeded');

    $this->call('RolesTableSeeder');
    $this->command->info('Roles table seeded');

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

}
