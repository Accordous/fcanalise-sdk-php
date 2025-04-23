<?php

namespace Accordous\FcAnalise\Enums;

enum Product: int
{
    case FC_REPORT = 1;

    case FC_SCORE = 9;

    case FC_SCORE_PLUS_ACTIONS = 10;

    case FC_REPORT_SECONDARY = 11;

    case FC_REPORT_SECONDARY_PLUS = 12;

    public function label(): string
    {
        return match ($this) {
            self::FC_REPORT => 'FC Report',
            self::FC_SCORE => 'FC Score',
            self::FC_SCORE_PLUS_ACTIONS => 'FC Score + Ações',
            self::FC_REPORT_SECONDARY => 'Complemento FC Report',
            self::FC_REPORT_SECONDARY_PLUS => 'Complemento FC Report+',
        };
    }
}
