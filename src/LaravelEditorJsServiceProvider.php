<?php

namespace AlAminFirdows\LaravelEditorjsHtml;

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
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}