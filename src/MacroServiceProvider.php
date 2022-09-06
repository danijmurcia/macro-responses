<?php

namespace Danimurcia\Responses;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        Collection::make($this->macros())
            ->reject(fn($class, $macro) => Collection::hasMacro($macro))
            ->each(fn($class, $macro) => Collection::macro($macro, app($class)()));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config/responses.php' => config_path('responses.php')]);
    }

    private function macros(): array
    {
        return [
            'ok' => \Danijmurcia\MacroResponses\Macros\Ok::class,
            'error' => \Danijmurcia\MacroResponses\Macros\Error::class,
        ];
    }
}
