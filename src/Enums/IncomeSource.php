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

    public function label(): string
    {
        return match ($this) {
            self::NOT_INFORMED => 'Renda Não Informada',
            self::PUBLIC_SERVANT_STATUTORY => 'Funcionário Público (Estatutário)',
            self::PUBLIC_SERVANT_CLT => 'Funcionário Público (CLT)',
            self::ENTREPRENEUR => 'Empresário',
            self::FREELANCER => 'Profissional liberal ou autônomo',
            self::RETIRED_PENSIONER => 'Aposentado / Pensionista',
            self::RENTAL_INCOME => 'Renda de aluguel',
            self::ALIMONY => 'Pensão alimentícia ou judicial',
            self::INTERN_SCHOLARSHIP => 'Estagiário / Bolsista',
            self::PRIVATE_EMPLOYEE => 'Func. registrado por empresa ou pessoa física (CLT)',
            self::MILITARY => 'Militar',
            self::CREDIT_CARD_LIMIT => 'Limite de Cartão de crédito',
            self::OTHER => 'Outro',
            self::BANK_STATEMENT => 'Movimentação Bancária (extratos)'
        };
    }
}
