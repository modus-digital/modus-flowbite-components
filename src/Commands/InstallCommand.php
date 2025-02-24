<?php

namespace ModusDigital\ModusUI\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class InstallCommand extends Command
{
    /** @var string */
    protected $signature = 'modus:install-ui {--force}';

    /** @var string */
    protected $description = 'Checks if all required packages are installed and publishes the assets';

    public function handle(): void
    {
        $this->info('Modus UI installed successfully');

        // Check if the assets are published
        if (!$this->assetsInstalled() || $this->option('force')) {
            $this->info('Publishing the assets');
            $this->call('vendor:publish', ['--tag' => 'modus-ui-assets']);

            $this->info('Modus UI installed successfully');
        } else {
            if ($this->checkPackages()) {
                $this->info('Modus UI already installed');
            } else {
                $this->error('Modus UI could not be installed');
            }
        }

    }

    // check if the required packages are installed
    private function checkPackages(): bool
    {
        $this->info('Checking if all required packages are installed');

        // Vereiste pakketten
        $requiredPackages = ['tailwindcss', 'flowbite', 'alpinejs'];

        // Controleer of package.json bestaat
        if (!File::exists(base_path('package.json'))) {
            $this->error('package.json niet gevonden. Zorg ervoor dat je project een Node.js configuratie heeft.');
            return false;
        }

        // Controleer of de node_modules map bestaat
        if (!File::exists(base_path('node_modules'))) {
            $this->warn('De node_modules map bestaat niet. Voer npm install of yarn install uit.');
            return false;
        }

        // Laad de package.json inhoud
        $packageJson = json_decode(File::get(base_path('package.json')), true);

        if (!$packageJson) {
            $this->error('package.json kan niet worden gelezen of is niet geldig JSON.');
            return false;
        }

        // Controleer of de vereiste pakketten zijn geïnstalleerd
        $missingPackages = [];
        foreach ($requiredPackages as $package) {
            if (
                (!isset($packageJson['dependencies'][$package]) && !isset($packageJson['devDependencies'][$package])) ||
                !File::exists(base_path("node_modules/{$package}"))
            ) {
                $missingPackages[] = $package;
            }
        }

        // Resultaat weergeven
        if (empty($missingPackages)) {
            $this->info('Alle vereiste pakketten zijn geïnstalleerd.');
        } else {
            $this->warn('De volgende vereiste pakketten ontbreken of zijn niet geïnstalleerd: ' . implode(', ', $missingPackages));
            
            // Prompt the user to install the missing packages
            if ($this->confirm('Wil je de ontbrekende pakketten installeren?')) {
                $result = Process::run('pnpm install -D ' . implode(' ', $missingPackages));

                if ($result->successful()) {
                    $this->info('De ontbrekende pakketten zijn succesvol geïnstalleerd.');
                } else {
                    $this->error('Er is iets fout gegaan bij het installeren van de ontbrekende pakketten.');
                }
            } else {
                $this->info('You can run `pnpm install` to install the missing packages.');
            }
        }

        return true;
    }

    private function assetsInstalled(): bool
    {
        if (!File::exists(public_path('vendor/modus/modus-ui'))) {
            return false;
        }

        return true;
    }
}