<?php

namespace Aurora\Console\Commands;

use Illuminate\Console\Command;
use DFurnes\Environmentalist\ConfiguresApplication;

class SetupCommand extends Command
{
    use ConfiguresApplication;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aurora:setup {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure your application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->createEnvironmentFile($this->option('reset'));

        $this->section('Set Northstar environment variables', function () {
            $environments = [
                'http://northstar.test',
                'https://identity-dev.dosomething.org',
                'https://identity-qa.dosomething.org',
            ];

            $this->chooseEnvironmentVariable('NORTHSTAR_URL', 'Choose a Northstar environment', $environments);
            $this->setEnvironmentVariable('NORTHSTAR_CLIENT_ID', 'Enter the OAuth Client ID');
            $this->setEnvironmentVariable('NORTHSTAR_CLIENT_SECRET', 'Enter the OAuth Client Secret');
        });

        $this->line('Creating application key');
        $this->call('key:generate');

        $this->line('Fetching public key from Northstar');
        $this->call('gateway:key');

        $this->line('Running database migrations');
        $this->call('migrate');

        $this->comment('Let\'s do this! ✨');
    }
}
