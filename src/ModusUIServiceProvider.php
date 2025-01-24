<?php

namespace ModusDigital\ModusUI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use ModusDigital\ModusUI\Commands\InstallCommand;
use Composer\InstalledVersions;

final class ModusUIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'modus-ui');
        $this->registerComponents();
        $this->registerComponentPublishers();

        $this->handleAssetServing();
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/modus-ui.php', 'modus-ui');
    }

    private function registerComponents(): self
    {
        Blade::componentNamespace('ModusDigital\\ModusUI\\View\\Components\\Form', config('modus-ui.prefix'));

        Blade::component('modus-ui::toasts', config('modus-ui.prefix').'::toasts');

        return $this;
    }

    private function registerComponentPublishers(): self
    {
        // Config
        $this->publishes(
            paths: [ __DIR__.'/../config/modus-ui.php' => config_path('modus-ui.php') ], 
            groups: 'modus-ui-config'
        );

        // Views
        $this->publishes(
            paths: [ __DIR__.'/../resources/views' => resource_path('views/components') ], 
            groups: 'modus-ui-views'
        );

        // Js Assets
        $this->publishes(
            paths: [ __DIR__.'/../resources/dist' => public_path('vendor/modus/modus-ui') ], 
            groups: 'modus-ui-assets'
        );

        return $this;
    }

    private function handleAssetServing()
    {
        Blade::directive('modusUiScripts', function () {
            $version = InstalledVersions::getPrettyVersion('modus-digital/modus-ui');
            $scripts = [];
            
            if (is_file(__DIR__ . '/../resources/hot')) {
                $url = rtrim(file_get_contents(__DIR__ . '/../resources/hot'));

                foreach (glob(__DIR__ . '/../resources/ts/*.ts') as $file) {
                    $relativePath = str_replace(__DIR__ . '/../resources/ts/', '', $file);
                    $scripts[] = sprintf('<script type="module" src="%s"></script>', "{$url}/resources/ts/{$relativePath}");
                }

                $scripts[] = sprintf('<script type="module" src="%s" defer></script>', "{$url}/@vite/client");
            } else {
                foreach (glob(__DIR__ . '/../resources/dist/*.js') as $file) {
                    $relativePath = str_replace(__DIR__ . '/../resources/dist/', '', $file);
                    $scripts[] = sprintf('<script type="module" src="%s"></script>', asset('vendor/modus/modus-ui/'.$relativePath.'?v='.$version));
                }
            }

            // Config
            $scripts[] = sprintf('<script>window.ModusUIConfig = %s</script>', json_encode(config('modus-ui')));

            return implode("\n", $scripts);
        });
    }
}
