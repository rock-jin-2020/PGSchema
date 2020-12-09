<?php

namespace Jinjian\PGSchema;

use Illuminate\Support\ServiceProvider;
use Jinjian\PGSchema\Commands\PGMigrateCommand;
use Jinjian\PGSchema\Commands\PGMigrateAllCommand;
use Jinjian\PGSchema\Commands\PGRefreshCommand;
use Jinjian\PGSchema\Commands\PGResetCommand;
use Jinjian\PGSchema\Commands\PGRollbackCommand;
use Jinjian\PGSchema\Commands\PGSeedCommand;

/**
 * Class PGSchemaServiceProvider
 *
 * @package Jinjian\PGSchema
 */
class PGSchemaServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('pgschema', function () {
            return new PGSchema();
        });
        $this->app->singleton('pgschema.migrate', function ($app) {
            return new PGMigrateCommand($app['migrator']);
        });
        $this->app->singleton('pgschema.migrate_all', function ($app) {
            return new PGMigrateAllCommand($app['migrator']);
        });
        $this->app->singleton('pgschema.rollback', function ($app) {
            return new PGRollbackCommand($app['migrator']);
        });
        $this->app->singleton('pgschema.reset', function ($app) {
            return new PGResetCommand($app['migrator']);
        });
        $this->app->singleton('pgschema.refresh', function ($app) {
            return new PGRefreshCommand();
        });
        $this->app->singleton('pgschema.seed', function ($app) {
            return new PGSeedCommand($app['db']);
        });
        $this->commands([
            'pgschema.migrate',
            'pgschema.migrate_all',
            'pgschema.rollback',
            'pgschema.reset',
            'pgschema.refresh',
            'pgschema.seed',
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
