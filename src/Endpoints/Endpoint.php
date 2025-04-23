<?php

namespace Accordous\FcAnalise\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Accordous\FcAnalise\Requests\ValidatesRequests;

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
