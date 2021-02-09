<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('role', function($roles){
          return "<?php if(auth()->check() && auth()->user()->hasRoleBySlug($roles)) : ?>";
        });
        Blade::directive('endrole', function($roles){
          return "<?php endif; ?>";
        });
    }
}
