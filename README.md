# FC Análise SDK PHP

A PHP SDK for the FC Análise API that provides tenant analysis and property rental services.

## Requirements

- PHP 8.2 or higher
- Laravel 10.0 or higher

## Installation

You can install the package via composer:

```bash
composer require accordous/fcanalise-sdk-php
```

## Configuration

1. Publish the configuration file:

```bash
php artisan vendor:publish --tag="fcanalise-config"
```

2. Add the following variables to your `.env` file:

```env
FCANALISE_BASE_URL=https://api.fichacertadigital.com.br
FCANALISE_LOGIN=your_login
FCANALISE_PASSWORD=your_password
```

## Usage

### Basic Setup

```php
use Accordous\FcAnalise\FcAnalise;
use Accordous\FcAnalise\Enums\PropertyType;
use Accordous\FcAnalise\Enums\ApplicantType;
use Accordous\FcAnalise\Enums\IncomeSource;

// The client will automatically load configuration from .env
$client = new FcAnalise();

// Or you can manually set the configuration
$client = new FcAnalise(
    'https://api.example.com',
    'your_login',
    'your_password'
);
```

### Creating a Solicitation

```php
$response = $client->solicitation()->create([
    'produtos' => [1], // FC REPORT
    'locacao' => [
        'codigo_imovel' => '#ABC1234',
        'aluguel' => '5000',
        'condominio' => '3500',
        'iptu' => '100.50',
        'tipo_imovel' => PropertyType::RESIDENTIAL,
        'endereco' => [
            'cep' => '20751380',
            'logradouro' => 'Rua Exemplo',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '123',
            'complemento' => 'Sala 45'
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

// Returns: ['id' => 123, 'message' => 'Solicitação cadastrada']
```

### Checking Solicitation Status

```php
$status = $client->solicitation()->status(123);
// Returns: ['status' => 'PENDING', 'message' => 'Análise em andamento']
```

## Property Types

Available property types:
- `PropertyType::RESIDENTIAL` - Residential property
- `PropertyType::NON_RESIDENTIAL` - Non-residential property

## Applicant Types

Available applicant types:
- `ApplicantType::TENANT` - Tenant
- `ApplicantType::GUARANTOR` - Guarantor
- `ApplicantType::TENANT_SPOUSE` - Tenant's spouse
- `ApplicantType::GUARANTOR_SPOUSE` - Guarantor's spouse
- `ApplicantType::OTHERS` - Others

## Income Sources

Available income sources:
- `IncomeSource::NOT_INFORMED` (1)
- `IncomeSource::PUBLIC_SERVANT_STATUTORY` (2)
- `IncomeSource::PUBLIC_SERVANT_CLT` (3)
- `IncomeSource::ENTREPRENEUR` (4)
- `IncomeSource::FREELANCER` (5)
- `IncomeSource::RETIRED_PENSIONER` (6)
- `IncomeSource::RENTAL_INCOME` (7)
- `IncomeSource::ALIMONY` (8)
- `IncomeSource::INTERN_SCHOLARSHIP` (9)
- `IncomeSource::PRIVATE_EMPLOYEE` (11)
- `IncomeSource::MILITARY` (12)
- `IncomeSource::CREDIT_CARD_LIMIT` (13)
- `IncomeSource::OTHER` (14)
- `IncomeSource::BANK_STATEMENT` (15)

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
