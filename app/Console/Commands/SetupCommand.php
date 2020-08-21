<?php

namespace Aurora\Console\Commands;

use DFurnes\Environmentalist\ConfiguresApplication;
use Illuminate\Console\Command;

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

            $this->chooseEnvironmentVariable(
                'NORTHSTAR_URL',
                'Choose a Northstar environment',
                $environments,
            );
            $this->setEnvironmentVariable(
                'NORTHSTAR_CLIENT_ID',
                'Enter the OAuth Client ID',
            );
            $this->setEnvironmentVariable(
                'NORTHSTAR_CLIENT_SECRET',
                'Enter the OAuth Client Secret',
            );
        });

        $this->runArtisanCommand('key:generate', 'Creating application key');

        $this->runArtisanCommand(
            'gateway:key',
            'Fetching public key from Northstar',
        );

        $this->runArtisanCommand('migrate', 'Running database migrations');

        $this->comment('Let\'s do this! ✨');
    }
}
