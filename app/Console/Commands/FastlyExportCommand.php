<?php

namespace Aurora\Console\Commands;

use Aurora\Services\Fastly;
use Illuminate\Console\Command;

class FastlyExportCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'fastly:export';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Export Fastly dictionaries from this app\'s service.';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle(Fastly $fastly)
  {
    $redirects = $fastly->getAllRedirects();
    $this->line(json_encode($redirects, JSON_PRETTY_PRINT));
  }
}
