<?php

namespace Accordous\FcAnalise\Resources;

use Illuminate\Http\Client\PendingRequest;
use Accordous\FcAnalise\Data\SolicitationData;
use Accordous\FcAnalise\Enums\PropertyType;
use Accordous\FcAnalise\Enums\ApplicantType;
use Accordous\FcAnalise\Enums\IncomeSource;

class SolicitationResource
{
    public function __construct(
        private readonly PendingRequest $client
    ) {}

    /**
     * Create a new solicitation
     *
     * @param array{
     *  produtos: array<int>,
     *  locacao: array{
     *      codigo_imovel?: string,
     *      aluguel?: string,
     *      condominio?: string,
     *      iptu?: string,
     *      tipo_imovel: PropertyType|string,
     *      endereco?: array{
     *          cep: string,
     *          logradouro: string,
     *          bairro: string,
     *          cidade: string,
     *          uf: string,
     *          numero: string,
     *          complemento?: string
     *      }
     *  },
     *  pretendente: array{
     *      tipo_pretendente: ApplicantType|string,
     *      residir?: bool,
     *      participante?: bool,
     *      nome: string,
     *      cpf: string,
     *      renda?: array{
     *          principal?: array{
     *              origem: IncomeSource|int|string,
     *              valor?: string
     *          },
     *          outra?: array{
     *              origem: IncomeSource|int|string,
     *              valor?: string
     *          },
     *          credito?: string
     *      }
     *  }
     * } $data
     * @return array{id: int, message: string}
     */
    public function create(array $data): array
    {
        $response = $this->client->post('/solicitation/', $data);

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response->json();
    }

    /**
     * Get solicitation status
     *
     * @param int $id
     * @return array
     */
    public function status(int $id): array
    {
        $response = $this->client->get("/solicitation/{$id}/status");

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response->json();
    }
}
