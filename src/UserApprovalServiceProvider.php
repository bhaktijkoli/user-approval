<?php

namespace BhaktijKoli\UserApproval;

use Illuminate\Support\ServiceProvider;

class UserApprovalServiceProvider extends ServiceProvider
{
  /**
  * Register services.
  *
  * @return void
  */
  public function register()
  {
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    $this->publishes([
      __DIR__.'/database/migrations/' => database_path('migrations')
    ], 'migrations');
  }

  /**
  * Bootstrap services.
  *
  * @return void
  */
  public function boot()
  {
    //
  }
}
