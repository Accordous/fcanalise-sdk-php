<?php

namespace Accordous\FcAnalise\Endpoints;

use Accordous\FcAnalise\Enums\IncomeSource;
use Accordous\FcAnalise\Enums\Product;
use Illuminate\Validation\Rule;

class SolicitationEndpoint extends Endpoint
{
    /**
     * List solicitations with pagination, sorting and filtering
     *
     * @param array{
     *  perPage?: int,
     *  page?: int,
     *  sort?: string,
     *  start_date?: string,
     *  end_date?: string,
     *  filter?: string
     * } $args
     */
    public function list(array $args = []): array
    {
        $response = $this->client->get('/solicitation/', [
            'perPage' => $args['perPage'] ?? 25,
            'page' => $args['page'] ?? 1,
            'sort' => $args['sort'] ?? null,
            'start_date' => $args['start_date'] ?? null,
            'end_date' => $args['end_date'] ?? null,
            'filter' => $args['filter'] ?? null,
        ]);

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Create a new solicitation
     *
     * @return array{id: int, message: string}
     */
    public function create(array $data): array
    {
        // Validate using rules defined in this class
        $validatedData = $this->validateData($data, $this->rules('POST'));

        $response = $this->client->post('/solicitation/', $validatedData);

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Get solicitation status
     */
    public function show(int $id): array
    {
        $response = $this->client->get("/solicitation/{$id}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Update a single solicitation by ID
     */
    public function update(int $id, array $data): array
    {
        // Validate using rules defined in this class, adapting for update
        $validatedData = $this->validateData($data, $this->rules('PUT'));

        $response = $this->client->put("/solicitation/{$id}", $validatedData);

        // Consider checking $response->successful() or $response->failed() for update
        return $response->json();
    }

    /**
     * Define validation rules for solicitation data.
     *
     * @param  string  $method  The HTTP method ('POST' for create, 'PUT' for update)
     */
    protected function rules(string $method = 'POST'): array
    {
        $isUpdate = $method === 'PUT';
        $requiredRule = $isUpdate ? 'sometimes' : 'required';

        return [
            'produtos' => [$requiredRule, 'array'],
            'produtos.*' => ['integer', Rule::enum(Product::class)],

            'locacao' => [$requiredRule, 'array'],
            'locacao.codigo_imovel' => ['sometimes', 'string'],
            'locacao.aluguel' => ['sometimes', 'numeric'],
            'locacao.condominio' => ['sometimes', 'numeric'],
            'locacao.iptu' => ['sometimes', 'numeric'],
            'locacao.tipo_imovel' => [$requiredRule, 'string'],

            'locacao.endereco' => ['sometimes', 'array'],
            'locacao.endereco.cep' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.logradouro' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.bairro' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.cidade' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.uf' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.numero' => ['required_with:locacao.endereco', 'string'],
            'locacao.endereco.complemento' => ['sometimes', 'string'],

            'pretendente' => [$requiredRule, 'array'],
            'pretendente.tipo_pretendente' => [$requiredRule, 'string'],
            'pretendente.residir' => ['sometimes', 'boolean'],
            'pretendente.participante' => ['sometimes', 'boolean'],
            'pretendente.nome' => [$requiredRule, 'string'],
            'pretendente.cpf' => [$requiredRule, 'string'],

            'pretendente.renda' => ['sometimes', 'array'],
            'pretendente.renda.principal' => ['sometimes', 'array'],
            'pretendente.renda.principal.origem' => ['required_with:pretendente.renda.principal', Rule::enum(IncomeSource::class)],
            'pretendente.renda.principal.valor' => ['sometimes', 'numeric'],

            'pretendente.renda.outra' => ['sometimes', 'array'],
            'pretendente.renda.outra.origem' => ['required_with:pretendente.renda.outra', Rule::enum(IncomeSource::class)],
            'pretendente.renda.outra.valor' => ['sometimes', 'numeric'],

            'pretendente.renda.credito' => ['sometimes', 'numeric'],
        ];
    }
}
