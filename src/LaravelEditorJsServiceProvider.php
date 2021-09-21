<?php

namespace AlAminFirdows\LaravelEditorJs;

use Illuminate\Support\ServiceProvider;

class LaravelEditorJsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel_editorjs.php', 'laravel_editorjs');

        $this->app->singleton('laravel-editorjs', static function ($app) {
            return new LaravelEditorJs;
        });
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel_editorjs');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel_editorjs.php' => config_path('laravel_editorjs.php'),
            ], 'laravel_editorjs-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => $this->app->resourcePath('views/vendor/laravel_editorjs'),
            ], 'laravel_editorjs-views');
        }
    }
}