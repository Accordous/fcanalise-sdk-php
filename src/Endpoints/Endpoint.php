<?php

namespace Accordous\FcAnalise\Endpoints;

use Accordous\FcAnalise\Requests\ValidatesRequests;
use Illuminate\Http\Client\PendingRequest;

abstract class Endpoint
{
    use ValidatesRequests;

    public function __construct(
        protected readonly PendingRequest $client
    ) {}

    protected function rules(): array
    {
        return [];
    }
}
