<?php

namespace AlAminFirdows\LaravelEditorJs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

        /**
         * Blade directive to render editor.js blocks.
         *
         * @param mixed $blocks The blocks of content to be rendered.
         * @return string Rendered HTML content.
         */
        Blade::directive('editorJsRender', function ($blocks) {
            return "<?php echo app('laravel-editorjs')->render($blocks); ?>";
        });
    }
}
