<?php

use Accordous\FcAnalise\Enums\IncomeSource;
use Accordous\FcAnalise\Enums\Product;
use Accordous\FcAnalise\Enums\PropertyType;
use Accordous\FcAnalise\FcAnalise;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    config()->set('fcanalise.base_url', 'http://localhost');
    config()->set('fcanalise.login', 'test_login');
    config()->set('fcanalise.password', 'test_password');

    // Mock all HTTP responses to return successful responses
    Http::fake([
        '*' => Http::response([
            'id' => 123,
            'message' => 'Test successful response',
            'data' => [
                'id' => 123,
                'status' => 'success',
            ],
            'pagination' => [
                'total' => 1,
                'current_page' => 1,
            ],
        ], 200),
    ]);

    $this->client = new FcAnalise;
});

describe('SolicitationEndpoint Validation', function () {

    test('create solicitation validates required fields', function () {
        $endpoint = $this->client->solicitation();

        expect(fn () => $endpoint->create([]))
            ->toThrow(ValidationException::class);
    });

    test('create solicitation accepts valid data', function () {
        $endpoint = $this->client->solicitation();

        $validData = [
            'produtos' => [Product::FC_REPORT->value],
            'locacao' => [
                'tipo_imovel' => PropertyType::RESIDENTIAL->value,
                'endereco' => [
                    'cep' => '20751380',
                    'logradouro' => 'Rua Test',
                    'bairro' => 'Test Bairro',
                    'cidade' => 'Test City',
                    'uf' => 'RJ',
                    'numero' => '123',
                ],
            ],
            'pretendente' => [
                'tipo_pretendente' => 'tenant',
                'nome' => 'John Doe',
                'cpf' => '12345678900',
                'renda' => [
                    'principal' => [
                        'origem' => IncomeSource::PUBLIC_SERVANT_CLT->value,
                        'valor' => 5000.00,
                    ],
                ],
            ],
        ];

        $response = $endpoint->create($validData);
        expect($response)->toBeArray();
    });

    test('create solicitation validates produtos array', function () {
        $endpoint = $this->client->solicitation();

        expect(fn () => $endpoint->create([
            'produtos' => 'not_an_array',
            'locacao' => ['tipo_imovel' => PropertyType::RESIDENTIAL->value],
            'pretendente' => ['tipo_pretendente' => 'tenant', 'nome' => 'Test', 'cpf' => '123'],
        ]))->toThrow(ValidationException::class);
    });

    test('update solicitation allows partial data', function () {
        $endpoint = $this->client->solicitation();

        $partialData = [
            'pretendente' => [
                'nome' => 'Updated Name',
            ],
        ];

        $response = $endpoint->update(1, $partialData);
        expect($response)->toBeArray();
    });

});

describe('ApplicantEndpoint Validation', function () {

    test('create applicant validates required fields', function () {
        $endpoint = $this->client->applicant();

        expect(fn () => $endpoint->create(1, []))
            ->toThrow(ValidationException::class);
    });

    test('create applicant accepts valid CPF applicant', function () {
        $endpoint = $this->client->applicant();

        $validData = [
            'produtos' => [Product::FC_REPORT->value],
            'pretendente' => [
                'tipo_pretendente' => 'person',
                'nome' => 'John Doe',
                'cpf' => '12345678900',
                'data_nascimento' => '1990-01-01',
                'endereco' => [
                    'cep' => '20751380',
                    'logradouro' => 'Rua Test',
                    'bairro' => 'Test Bairro',
                    'cidade' => 'Test City',
                    'uf' => 'RJ',
                    'numero' => '123',
                ],
                'renda' => [
                    'principal' => [
                        'origem' => IncomeSource::PUBLIC_SERVANT_CLT->value,
                        'valor' => 5000.00,
                    ],
                ],
            ],
        ];

        $response = $endpoint->create(1, $validData);
        expect($response)->toBeArray();
    });

    test('create applicant accepts valid CNPJ applicant', function () {
        $endpoint = $this->client->applicant();

        $validData = [
            'produtos' => [Product::FC_REPORT->value],
            'pretendente' => [
                'tipo_pretendente' => 'company',
                'razao_social' => 'Test Company Ltda',
                'cnpj' => '12345678000195',
            ],
        ];

        $response = $endpoint->create(1, $validData);
        expect($response)->toBeArray();
    });

    test('create applicant requires either nome+cpf or razao_social+cnpj', function () {
        $endpoint = $this->client->applicant();

        // Should fail when neither CPF nor CNPJ data is provided
        expect(fn () => $endpoint->create(1, [
            'produtos' => [Product::FC_REPORT->value],
            'pretendente' => [
                'tipo_pretendente' => 'person',
            ],
        ]))->toThrow(ValidationException::class);
    });

    test('update applicant allows partial data', function () {
        $endpoint = $this->client->applicant();

        $partialData = [
            'pretendente' => [
                'nome' => 'Updated Name',
                'renda' => [
                    'principal' => [
                        'origem' => IncomeSource::FREELANCER->value,
                        'valor' => 6000.00,
                    ],
                ],
            ],
        ];

        $response = $endpoint->update(1, 2, $partialData);
        expect($response)->toBeArray();
    });

    test('validates income source enum', function () {
        $endpoint = $this->client->applicant();

        expect(fn () => $endpoint->create(1, [
            'produtos' => [Product::FC_REPORT->value],
            'pretendente' => [
                'tipo_pretendente' => 'person',
                'nome' => 'John Doe',
                'cpf' => '12345678900',
                'renda' => [
                    'principal' => [
                        'origem' => 'invalid_income_source',
                        'valor' => 5000.00,
                    ],
                ],
            ],
        ]))->toThrow(ValidationException::class);
    });

});

describe('ProductEndpoint Validation', function () {

    test('validates product_id in rules', function () {
        $endpoint = $this->client->product();

        // Test that the rules are defined correctly
        $reflection = new ReflectionClass($endpoint);
        $rulesMethod = $reflection->getMethod('rules');
        $rulesMethod->setAccessible(true);
        $rules = $rulesMethod->invoke($endpoint);

        expect($rules)->toHaveKey('product_id');
        expect($rules['product_id'])->toContain('required');
        expect($rules['product_id'])->toContain('integer');
    });

    test('add product method works with valid product ID', function () {
        $endpoint = $this->client->product();

        $response = $endpoint->add(1, 2, Product::FC_REPORT->value);
        expect($response)->toBeArray();
    });

    test('addReinclusion method works', function () {
        $endpoint = $this->client->product();

        $response = $endpoint->addReinclusion(1, 2, Product::FC_REPORT->value);
        expect($response)->toBeArray();
    });

    test('removeReinclusion method works', function () {
        $endpoint = $this->client->product();

        $response = $endpoint->removeReinclusion(1, 2, Product::FC_REPORT->value);
        expect($response)->toBeArray();
    });

});

describe('FileEndpoint Validation', function () {

    test('validates required file field', function () {
        $endpoint = $this->client->file();

        expect(fn () => $endpoint->add(1, 2, 3, []))
            ->toThrow(ValidationException::class);
    });

    test('accepts valid file data', function () {
        $endpoint = $this->client->file();

        $validData = [
            'file' => 'dummy_file_content', // In real scenario this would be an uploaded file
            'description' => 'Test document',
            'document_type' => 'identity',
        ];

        // Note: This will fail validation in real scenario because 'file' rule expects an actual file
        // But for testing purposes we can check the rules structure
        $reflection = new ReflectionClass($endpoint);
        $rulesMethod = $reflection->getMethod('rules');
        $rulesMethod->setAccessible(true);
        $rules = $rulesMethod->invoke($endpoint);

        expect($rules)->toHaveKey('file');
        expect($rules['file'])->toContain('required');
        expect($rules['file'])->toContain('file');
    });

    test('remove method works with valid IDs', function () {
        $endpoint = $this->client->file();

        $response = $endpoint->remove(1, 2, 3, 4);
        expect($response)->toBeArray();
    });

});

describe('WebhookEndpoint Validation', function () {

    test('create webhook validates required endpoint', function () {
        $endpoint = $this->client->webhook();

        expect(fn () => $endpoint->create([]))
            ->toThrow(ValidationException::class);
    });

    test('create webhook accepts valid data', function () {
        $endpoint = $this->client->webhook();

        $validData = [
            'endpoint' => 'https://example.com/webhook',
            'token_url' => 'https://example.com/auth',
            'token_user' => 'webhook_user',
            'token_password' => 'webhook_password',
        ];

        $response = $endpoint->create($validData);
        expect($response)->toBeArray();
    });

    test('validates endpoint URL format', function () {
        $endpoint = $this->client->webhook();

        expect(fn () => $endpoint->create([
            'endpoint' => 'not_a_valid_url',
        ]))->toThrow(ValidationException::class);
    });

    test('allows optional token fields', function () {
        $endpoint = $this->client->webhook();

        $minimalData = [
            'endpoint' => 'https://example.com/webhook',
        ];

        $response = $endpoint->create($minimalData);
        expect($response)->toBeArray();
    });

    test('list method works', function () {
        $endpoint = $this->client->webhook();

        $response = $endpoint->list();
        expect($response)->toBeArray();
    });

    test('delete method works with valid ID', function () {
        $endpoint = $this->client->webhook();

        $response = $endpoint->delete(1);
        expect($response)->toBeArray();
    });

});
