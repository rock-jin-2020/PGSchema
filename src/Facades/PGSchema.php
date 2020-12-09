<?php

namespace Rock\PGSchema\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PGSchema
 *
 * @package Rock\PGSchema\Facades
 */
class PGSchema extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pgschema';
    }
}
