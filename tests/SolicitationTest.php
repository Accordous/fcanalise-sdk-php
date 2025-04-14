<?php

namespace Accordous\FcAnalise\Tests;

use Accordous\FcAnalise\FcAnalise;
use Accordous\FcAnalise\Enums\PropertyType;
use Accordous\FcAnalise\Enums\ApplicantType;
use Accordous\FcAnalise\Enums\IncomeSource;
use Illuminate\Support\Facades\Http;

class SolicitationTest extends TestCase
{
    private FcAnalise $client;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('fcanalise.base_url', 'https://api.example.com');
        config()->set('fcanalise.login', 'test_login');
        config()->set('fcanalise.password', 'test_password');

        $this->client = new FcAnalise();
    }

    public function test_can_create_solicitation(): void
    {
        Http::fake([
            '*/solicitation/*' => Http::response([
                'id' => 123,
                'message' => 'Solicitação cadastrada'
            ], 200)
        ]);

        $response = $this->client->solicitation()->create([
            'produtos' => [1],
            'locacao' => [
                'codigo_imovel' => '#ABC1234',
                'aluguel' => '5000',
                'condominio' => '3500',
                'iptu' => '100.50',
                'tipo_imovel' => PropertyType::RESIDENTIAL,
                'endereco' => [
                    'cep' => '20751380',
                    'logradouro' => 'Rua Xisto Baía',
                    'bairro' => 'Piedade',
                    'cidade' => 'Rio de Janeiro',
                    'uf' => 'RJ',
                    'numero' => '30',
                    'complemento' => 'apt 300'
                ]
            ],
            'pretendente' => [
                'tipo_pretendente' => ApplicantType::TENANT,
                'residir' => true,
                'nome' => 'João Silva',
                'cpf' => '12345678900',
                'renda' => [
                    'principal' => [
                        'origem' => IncomeSource::PUBLIC_SERVANT_CLT,
                        'valor' => '5000'
                    ],
                    'outra' => [
                        'origem' => IncomeSource::RENTAL_INCOME,
                        'valor' => '3000'
                    ]
                ]
            ]
        ]);

        $this->assertEquals(123, $response['id']);
        $this->assertEquals('Solicitação cadastrada', $response['message']);
    }

    public function test_can_get_solicitation_status(): void
    {
        Http::fake([
            '*/solicitation/123/status' => Http::response([
                'status' => 'PENDING',
                'message' => 'Análise em andamento'
            ], 200)
        ]);

        $response = $this->client->solicitation()->status(123);

        $this->assertEquals('PENDING', $response['status']);
        $this->assertEquals('Análise em andamento', $response['message']);
    }
}
