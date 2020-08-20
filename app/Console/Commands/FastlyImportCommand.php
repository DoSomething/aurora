<?php

namespace Aurora\Console\Commands;

use Aurora\Resources\Redirect;
use Aurora\Services\Fastly;
use Illuminate\Console\Command;

class FastlyImportCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'fastly:import {path}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Import Fastly dictionaries to this app\'s service.';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle(Fastly $fastly)
  {
    $input = file_get_contents($this->argument('path'));

    $redirects = array_map(function ($redirect) {
      return new Redirect($redirect);
    }, json_decode($input, true));

    $url = config('services.fastly.service_url');
    $confirmation =
      'Would you like to create ' .
      count($redirects) .
      ' redirects on ' .
      $url .
      '?';
    if ($this->confirm($confirmation)) {
      foreach ($redirects as $redirect) {
        $this->line(
          'Redirecting "' .
            $redirect->path .
            '" to "' .
            $redirect->target .
            '" (' .
            $redirect->status .
            ')'
        );
        $fastly->createRedirect(
          $redirect->path,
          $redirect->target,
          $redirect->status
        );
      }
    }
  }
}
