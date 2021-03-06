<?php

namespace Rock\PGSchema;

use Illuminate\Support\ServiceProvider;
use Rock\PGSchema\Commands\PGCreateSchema;
use Rock\PGSchema\Commands\PGMigrateCommand;
use Rock\PGSchema\Commands\PGRefreshCommand;
use Rock\PGSchema\Commands\PGResetCommand;
use Rock\PGSchema\Commands\PGRollbackCommand;
use Rock\PGSchema\Commands\PGSeedCommand;

/**
 * Class PGSchemaServiceProvider
 *
 * @package Rock\PGSchema
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

        $this->app->singleton('pgschema.create-schema', function ($app) {
            return new PGCreateSchema($app['pgschema']);
        });

        $this->commands([
            'pgschema.migrate',
            'pgschema.rollback',
            'pgschema.reset',
            'pgschema.refresh',
            'pgschema.seed',
            'pgschema.create-schema'
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
