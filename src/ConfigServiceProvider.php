<?php

namespace Feihuangorg\Config;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('{{lower_vendor}}/{{lower_name}}');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind it only once so we can reuse in IoC
        $this->app->singleton('Feihuangorg\Config\Repository', function($app, $items)
        {
            $writer = new FileWriter($app['files'], $app['path.config']);
            return new Repository($items, $writer);
        });

        // Capture the loaded configuration items
        $config_items = app('config')->all();

        $this->app['config'] = $this->app->share(function($app) use ($config_items)
        {
            return $app->make('Feihuangorg\Config\Repository', $config_items);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['FileWriter'];
    }
}
