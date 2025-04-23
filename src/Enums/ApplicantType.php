<?php

namespace Accordous\FcAnalise\Enums;

enum ApplicantType: string
{
    case TENANT = 'INQUILINO';
    case GUARANTOR = 'FIADOR';
    case TENANT_SPOUSE = 'CONJUGE_INQUILINO';
    case GUARANTOR_SPOUSE = 'CONJUGE_FIADOR';
    case OTHERS = 'OUTROS';

    public function label(): string
    {
        return match ($this) {
            self::TENANT => 'Inquilino',
            self::GUARANTOR => 'Fiador',
            self::TENANT_SPOUSE => 'Cônjuge Inquilino',
            self::GUARANTOR_SPOUSE => 'Cônjuge Fiador',
            self::OTHERS => 'Outros',
        };
    }
}
