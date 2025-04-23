<?php

namespace Accordous\FcAnalise\Enums;

enum PropertyType: string
{
    case RESIDENTIAL = 'RESIDENCIAL';
    case NON_RESIDENTIAL = 'NAO_RESIDENCIAL';

    public function label(): string
    {
        return match ($this) {
            self::RESIDENTIAL => 'Residencial',
            self::NON_RESIDENTIAL => 'Não Residencial',
        };
    }
}
