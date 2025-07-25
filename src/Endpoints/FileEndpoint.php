<?php

namespace Accordous\FcAnalise\Endpoints;

class FileEndpoint extends Endpoint
{
    /**
     * Add a file (attachment) to a product for an applicant
     */
    public function add(int $solicitationId, int $applicantId, int $productId, array $data): array
    {
        $validatedData = $this->validateData($data, $this->rules());

        $response = $this->client->post("/solicitation/{$solicitationId}/applicant/{$applicantId}/product/{$productId}/file", $validatedData);

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Remove a file (attachment) from a product for an applicant
     */
    public function remove(int $solicitationId, int $applicantId, int $productId, int $fileId): array
    {
        $response = $this->client->delete("/solicitation/{$solicitationId}/applicant/{$applicantId}/product/{$productId}/file/{$fileId}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    protected function rules(): array
    {
        return [
            'file' => ['required', 'file'],
            'description' => ['sometimes', 'string'],
            'document_type' => ['sometimes', 'string'],
        ];
    }
}
