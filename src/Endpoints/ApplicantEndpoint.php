<?php

namespace Accordous\FcAnalise\Endpoints;

use Accordous\FcAnalise\Enums\IncomeSource;
use Illuminate\Validation\Rule;

class ApplicantEndpoint extends Endpoint
{
    /**
     * Create a new applicant for a solicitation
     */
    public function create(int $solicitationId, array $data): array
    {
        $response = $this->client->post("/solicitation/{$solicitationId}/applicant/", $this->validateData($data, $this->rules()));

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Get applicant details
     */
    public function show(int $solicitationId, int $applicantId): array
    {
        $response = $this->client->get("/solicitation/{$solicitationId}/applicant/{$applicantId}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Update an applicant
     */
    public function update(int $solicitationId, int $applicantId, array $data): array
    {
        $validatedData = $this->validateData($data, $this->updateRules());

        $response = $this->client->put("/solicitation/{$solicitationId}/applicant/{$applicantId}", $validatedData);

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Delete an applicant
     */
    public function delete(int $solicitationId, int $applicantId): array
    {
        $response = $this->client->delete("/solicitation/{$solicitationId}/applicant/{$applicantId}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    protected function rules(): array
    {
        return [
            'produtos' => ['required', 'array'],
            'produtos.*' => ['integer'],

            'pretendente' => ['required', 'array'],
            'pretendente.tipo_pretendente' => ['required', 'string'],
            'pretendente.residir' => ['sometimes', 'boolean'],
            'pretendente.participante' => ['sometimes', 'boolean'],

            // For regular applicants (CPF)
            'pretendente.nome' => ['required_without:pretendente.razao_social', 'string'],
            'pretendente.cpf' => ['required_without:pretendente.cnpj', 'string'],
            'pretendente.data_nascimento' => ['sometimes', 'date'],
            'pretendente.nome_mae' => ['sometimes', 'string'],

            // For company applicants (CNPJ)
            'pretendente.razao_social' => ['required_without:pretendente.nome', 'string'],
            'pretendente.cnpj' => ['required_without:pretendente.cpf', 'string'],

            // Address
            'pretendente.endereco' => ['sometimes', 'array'],
            'pretendente.endereco.cep' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.logradouro' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.bairro' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.cidade' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.uf' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.numero' => ['required_with:pretendente.endereco', 'string'],
            'pretendente.endereco.complemento' => ['sometimes', 'string'],

            // Income information
            'pretendente.renda' => ['sometimes', 'array'],
            'pretendente.renda.principal' => ['sometimes', 'array'],
            'pretendente.renda.principal.origem' => ['required_with:pretendente.renda.principal', Rule::enum(IncomeSource::class)],
            'pretendente.renda.principal.valor' => ['sometimes', 'numeric'],

            'pretendente.renda.outra' => ['sometimes', 'array'],
            'pretendente.renda.outra.origem' => ['required_with:pretendente.renda.outra', Rule::enum(IncomeSource::class)],
            'pretendente.renda.outra.valor' => ['sometimes', 'numeric'],
        ];
    }

    /**
     * Validation rules for updating an applicant
     */
    protected function updateRules(): array
    {
        return [
            'pretendente' => ['required', 'array'],
            'pretendente.tipo_pretendente' => ['sometimes', 'string'],
            'pretendente.residir' => ['sometimes', 'boolean'],
            'pretendente.participante' => ['sometimes', 'boolean'],
            'pretendente.cpf_pendente' => ['sometimes', 'boolean'],

            // For regular applicants (CPF)
            'pretendente.nome' => ['sometimes', 'string'],
            'pretendente.cpf' => ['sometimes', 'string'],
            'pretendente.data_nascimento' => ['sometimes', 'date'],
            'pretendente.nome_mae' => ['sometimes', 'string'],

            // For company applicants (CNPJ)
            'pretendente.razao_social' => ['sometimes', 'string'],
            'pretendente.cnpj' => ['sometimes', 'string'],

            // Income information
            'pretendente.renda' => ['sometimes', 'array'],
            'pretendente.renda.principal' => ['sometimes', 'array'],
            'pretendente.renda.principal.origem' => ['required_with:pretendente.renda.principal', Rule::enum(IncomeSource::class)],
            'pretendente.renda.principal.valor' => ['sometimes', 'numeric'],

            'pretendente.renda.outra' => ['sometimes', 'array'],
            'pretendente.renda.outra.origem' => ['required_with:pretendente.renda.outra', Rule::enum(IncomeSource::class)],
            'pretendente.renda.outra.valor' => ['sometimes', 'numeric'],
        ];
    }
}
