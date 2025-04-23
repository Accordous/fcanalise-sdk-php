<?php

namespace Accordous\FcAnalise\Enums;

enum SolicitationStatus: string
{
    case PENDING = 'PENDENTE';

    case FINISHED = 'FINALIZADO';

    case CANCELLED = 'CANCELADO';

    case ERROR = 'ERRO';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::FINISHED => 'Finalizado',
            self::CANCELLED => 'Cancelado',
            self::ERROR => 'Erro',
        };
    }
}
