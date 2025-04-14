<?php

namespace Accordous\FcAnalise\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Accordous\FcAnalise\FcAnalise
 */
class FcAnalise extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Accordous\FcAnalise\FcAnalise::class;
    }
}
