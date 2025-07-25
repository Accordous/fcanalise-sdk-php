<?php

namespace Accordous\FcAnalise\Endpoints;

use Accordous\FcAnalise\Enums\Product;
use Illuminate\Validation\Rule;

class ProductEndpoint extends Endpoint
{
    /**
     * Add a product to an applicant
     */
    public function add(int $solicitationId, int $applicantId, int $productId): array
    {
        $response = $this->client->post("/solicitation/{$solicitationId}/applicant/{$applicantId}/product/{$productId}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Add product reinclusion
     */
    public function addReinclusion(int $solicitationId, int $applicantId, int $productId): array
    {
        $response = $this->client->post("/solicitation/{$solicitationId}/applicant/{$applicantId}/product/{$productId}/reinclusion");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Remove product reinclusion
     */
    public function removeReinclusion(int $solicitationId, int $applicantId, int $productId): array
    {
        $response = $this->client->delete("/solicitation/{$solicitationId}/applicant/{$applicantId}/product/{$productId}/reinclusion");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    protected function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', Rule::enum(Product::class)],
        ];
    }
}
