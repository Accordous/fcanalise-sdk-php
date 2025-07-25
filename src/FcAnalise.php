<?php

namespace Accordous\FcAnalise;

use Accordous\FcAnalise\Endpoints\ApplicantEndpoint;
use Accordous\FcAnalise\Endpoints\FileEndpoint;
use Accordous\FcAnalise\Endpoints\ProductEndpoint;
use Accordous\FcAnalise\Endpoints\SolicitationEndpoint;
use Accordous\FcAnalise\Endpoints\SolicitationReportEndpoint;
use Accordous\FcAnalise\Endpoints\WebhookEndpoint;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class FcAnalise
{
    private PendingRequest $client;

    private string $baseUrl;

    private string $login;

    private string $password;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) (config('fcanalise.base_url') ?? ''), '/');
        $this->login = (string) (config('fcanalise.login') ?? '');
        $this->password = (string) (config('fcanalise.password') ?? '');

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

    public function solicitation(): SolicitationEndpoint
    {
        return new SolicitationEndpoint($this->client);
    }

    public function applicant(): ApplicantEndpoint
    {
        return new ApplicantEndpoint($this->client);
    }

    public function product(): ProductEndpoint
    {
        return new ProductEndpoint($this->client);
    }

    public function file(): FileEndpoint
    {
        return new FileEndpoint($this->client);
    }

    public function webhook(): WebhookEndpoint
    {
        return new WebhookEndpoint($this->client);
    }

    public function report(): SolicitationReportEndpoint
    {
        return new SolicitationReportEndpoint($this->client);
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
