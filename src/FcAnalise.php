<?php

namespace Accordous\FcAnalise;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Accordous\FcAnalise\Resources\SolicitationResource;

class FcAnalise
{
    private PendingRequest $client;
    private string $baseUrl;
    private string $login;
    private string $password;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('fcanalise.base_url'), '/');
        $this->login = config('fcanalise.login');
        $this->password = config('fcanalise.password');

        if (empty($this->login) || empty($this->password)) {
            throw new \InvalidArgumentException(
                'FC Análise credentials not found. Please provide them via constructor or .env file.'
            );
        }

        $this->client = Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'login' => $this->login,
                'password' => $this->password,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
    }

    public function solicitation(): SolicitationResource
    {
        return new SolicitationResource($this->client);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getClient(): PendingRequest
    {
        return $this->client;
    }
}
