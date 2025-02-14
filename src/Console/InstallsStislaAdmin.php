<?php

namespace Larastart\LaravelStaterkit\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallsStislaAdmin
{
    /**
     * Install the Stisla Admin.
     *
     * @return int|null
     */
    public function installStislaAdmin()
    {
        $totalSteps = 11;
        $currentStep = 1;

        $progressBar = $this->output->createProgressBar($totalSteps);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');

        $progressBar->setMessage('Starting installation...');
        $progressBar->start();

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/Http/Controllers', app_path('Http/Controllers'));
        $progressBar->setMessage('Controllers installed...');
        $progressBar->advance();

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/Http/Requests', app_path('Http/Requests'));
        $progressBar->setMessage('Requests installed...');
        $progressBar->advance();

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/resources/views', resource_path('views'));
        $progressBar->setMessage('Views installed...');
        $progressBar->advance();

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/View/Components', app_path('View/Components'));
        $progressBar->setMessage('Components installed...');
        $progressBar->advance();

        // Routes...
        copy(__DIR__.'/../../stubs/stisla/routes/web.php', base_path('routes/web.php'));
        copy(__DIR__.'/../../stubs/stisla/routes/auth.php', base_path('routes/auth.php'));
        $progressBar->setMessage('Routes installed...');
        $progressBar->advance();

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));
        $progressBar->setMessage('Dashboard route installed...');
        $progressBar->advance();


        // Assets...
        $assets = [
            'css',
            'fonts',
            'img',
            'js',
            'library',
        ];
        foreach ($assets as $asset) {
            (new Filesystem)->ensureDirectoryExists(public_path($asset));
            (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/'.$asset, public_path($asset));
            $progressBar->setMessage('Assets installed...');
            $progressBar->advance();
        }
        $progressBar->setMessage('Finalizing...');
        $progressBar->finish();
        $this->line('');

        $this->components->info('Stisla Admin installed successfully.');

    }
}
