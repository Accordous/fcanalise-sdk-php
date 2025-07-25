<?php

namespace Accordous\FcAnalise\Endpoints;

class WebhookEndpoint extends Endpoint
{
    /**
     * Create a new webhook
     */
    public function create(array $data): array
    {
        $validatedData = $this->validateData($data, $this->rules());

        $response = $this->client->post('/solicitation/report/webhook', $validatedData);

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * List all webhooks
     */
    public function list(): array
    {
        $response = $this->client->get('/solicitation/report/webhook');

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    /**
     * Delete a webhook
     */
    public function delete(int $webhookId): array
    {
        $response = $this->client->delete("/solicitation/report/webhook/{$webhookId}");

        if ($response->failed()) {
            throw new \Exception($response->json('message'));
        }

        return $response->json();
    }

    protected function rules(): array
    {
        return [
            'endpoint' => ['required', 'url'],
            'token_url' => ['sometimes', 'url'],
            'token_user' => ['sometimes', 'string'],
            'token_password' => ['sometimes', 'string'],
        ];
    }
}
