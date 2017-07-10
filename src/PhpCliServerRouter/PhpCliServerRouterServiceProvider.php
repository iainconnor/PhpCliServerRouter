<?php

namespace IainConnor\PhpCliServerRouter;

use Illuminate\Support\ServiceProvider;

class PhpCliServerRouterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        if ($this->app->runningInConsole()) {
            $this->commands([
                                BootServerCommand::class,
                            ]);
        }
    }
}
