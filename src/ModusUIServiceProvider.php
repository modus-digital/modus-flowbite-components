<?php

namespace ModusDigital\ModusUI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

final class ModusUIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'modus-ui');
        $this->registerComponents();
        $this->registerComponentPublishers();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/modus-ui.php', 'modus-ui');
    }

    private function registerComponents(): self
    {
        Blade::componentNamespace('ModusDigital\\ModusUI\\View\\Components\\Form', config('modus-ui.prefix'));

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
            paths: [ __DIR__.'/../resources/views' => resource_path('views/vendor/modus/modus-ui') ], 
            groups: 'modus-ui-views'
        );

        return $this;
    }
}

