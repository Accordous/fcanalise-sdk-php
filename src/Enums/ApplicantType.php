<?php

namespace Accordous\FcAnalise\Enums;

enum ApplicantType: string
{
    case TENANT = 'INQUILINO';
    case GUARANTOR = 'FIADOR';
    case TENANT_SPOUSE = 'CONJUGE_INQUILINO';
    case GUARANTOR_SPOUSE = 'CONJUGE_FIADOR';
    case OTHERS = 'OUTROS';
}
