<?php

namespace Accordous\FcAnalise\Enums;

enum IncomeSource: int
{
    case NOT_INFORMED = 1;
    case PUBLIC_SERVANT_STATUTORY = 2;
    case PUBLIC_SERVANT_CLT = 3;
    case ENTREPRENEUR = 4;
    case FREELANCER = 5;
    case RETIRED_PENSIONER = 6;
    case RENTAL_INCOME = 7;
    case ALIMONY = 8;
    case INTERN_SCHOLARSHIP = 9;
    case PRIVATE_EMPLOYEE = 11;
    case MILITARY = 12;
    case CREDIT_CARD_LIMIT = 13;
    case OTHER = 14;
    case BANK_STATEMENT = 15;
}
