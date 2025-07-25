<?php

use Accordous\FcAnalise\Enums\ApplicantType;
use Accordous\FcAnalise\Enums\IncomeSource;
use Accordous\FcAnalise\Enums\PropertyType;
use Accordous\FcAnalise\FcAnalise;

beforeEach(function () {
    config()->set('fcanalise.base_url', env('FCANALISE_BASE_URL'));
    config()->set('fcanalise.login', env('FCANALISE_LOGIN'));
    config()->set('fcanalise.password', env('FCANALISE_PASSWORD'));

    $this->client = new FcAnalise;
});

test('can create solicitation', function () {

    // skip for now
    $this->markTestSkipped();

    $response = $this->client->solicitation()->create([
        'produtos' => [1],
        'locacao' => [
            'codigo_imovel' => $this->faker->word,
            'aluguel' => $this->faker->randomFloat(2, 1000, 10000),
            'condominio' => $this->faker->randomFloat(2, 1000, 10000),
            'iptu' => $this->faker->randomFloat(2, 1000, 10000),
            'tipo_imovel' => PropertyType::RESIDENTIAL->value,
            'endereco' => [
                'cep' => '20751380',
                'logradouro' => 'Rua Xisto Baía',
                'bairro' => 'Piedade',
                'cidade' => 'Rio de Janeiro',
                'uf' => 'RJ',
                'numero' => '30',
                'complemento' => 'apt 300',
            ],
        ],
        'pretendente' => [
            'tipo_pretendente' => ApplicantType::TENANT->value,
            'residir' => true,
            'nome' => $this->faker->name,
            'cpf' => $this->faker->cpf,
            'renda' => [
                'principal' => [
                    'origem' => IncomeSource::PUBLIC_SERVANT_CLT->value,
                    'valor' => $this->faker->randomFloat(2, 1000, 10000),
                ],
                'outra' => [
                    'origem' => IncomeSource::RENTAL_INCOME->value,
                    'valor' => $this->faker->randomFloat(2, 1000, 10000),
                ],
            ],
        ],
    ]);

    // expect($response['id'])->toBe(123);
    expect($response['message'])->toBe('Solicitação cadastrada');
});

test('can get solicitation status', function () {

    // skip for now
    $this->markTestSkipped();

    // get a list of solicitations
    $response = $this->client->solicitation()->list();

    expect($response)->toHaveKeys(['data', 'pagination']);

    // get the first solicitation
    $solicitation = $response['data'][0];

    $response = $this->client->solicitation()->show($solicitation['id']);

    expect($response)->toHaveKey('data');
    expect($response['data'])->toHaveKey('id');
    expect($response['data']['id'])->toBe($solicitation['id']);
});
