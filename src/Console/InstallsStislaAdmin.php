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
        $this->line('Installing dependencies...');

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/Http/Controllers', app_path('Http/Controllers'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/Http/Requests', app_path('Http/Requests'));

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/resources/views', resource_path('views'));

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/stisla/app/View/Components', app_path('View/Components'));

        // Tests...
        if (! $this->installTests()) {
            return 1;
        }
        
        // Routes...
        copy(__DIR__.'/../../stubs/stisla/routes/web.php', base_path('routes/web.php'));
        copy(__DIR__.'/../../stubs/stisla/routes/auth.php', base_path('routes/auth.php'));

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));

        // Assets...
        (new Filesystem)->ensureDirectoryExists(public_path('css'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/css', public_path('css'));

        (new Filesystem)->ensureDirectoryExists(public_path('fonts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/fonts', public_path('fonts'));

        (new Filesystem)->ensureDirectoryExists(public_path('img'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/img', public_path('img'));

        (new Filesystem)->ensureDirectoryExists(public_path('js'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/js', public_path('js'));

        (new Filesystem)->ensureDirectoryExists(public_path('library'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stisla/public/library', public_path('library'));

        $this->line('Installing Stisla Admin...');
        $this->components->info('Stisla Admin installed successfully.');

    }
}
