<?php

use Accordous\FcAnalise\Endpoints\ApplicantEndpoint;
use Accordous\FcAnalise\Endpoints\FileEndpoint;
use Accordous\FcAnalise\Endpoints\ProductEndpoint;
use Accordous\FcAnalise\Endpoints\SolicitationEndpoint;
use Accordous\FcAnalise\Endpoints\SolicitationReportEndpoint;
use Accordous\FcAnalise\Endpoints\WebhookEndpoint;
use Accordous\FcAnalise\FcAnalise;

beforeEach(function () {
    config()->set('fcanalise.base_url', 'https://api.fichacerta.com.br');
    config()->set('fcanalise.login', 'test_login');
    config()->set('fcanalise.password', 'test_password');

    $this->client = new FcAnalise;
});

test('can instantiate solicitation endpoint', function () {
    $endpoint = $this->client->solicitation();

    expect($endpoint)->toBeInstanceOf(SolicitationEndpoint::class);
});

test('can instantiate applicant endpoint', function () {
    $endpoint = $this->client->applicant();

    expect($endpoint)->toBeInstanceOf(ApplicantEndpoint::class);
});

test('can instantiate product endpoint', function () {
    $endpoint = $this->client->product();

    expect($endpoint)->toBeInstanceOf(ProductEndpoint::class);
});

test('can instantiate file endpoint', function () {
    $endpoint = $this->client->file();

    expect($endpoint)->toBeInstanceOf(FileEndpoint::class);
});

test('can instantiate webhook endpoint', function () {
    $endpoint = $this->client->webhook();

    expect($endpoint)->toBeInstanceOf(WebhookEndpoint::class);
});

test('can instantiate report endpoint', function () {
    $endpoint = $this->client->report();

    expect($endpoint)->toBeInstanceOf(SolicitationReportEndpoint::class);
});

test('solicitation endpoint has all required methods', function () {
    $endpoint = $this->client->solicitation();

    expect(method_exists($endpoint, 'list'))->toBeTrue();
    expect(method_exists($endpoint, 'create'))->toBeTrue();
    expect(method_exists($endpoint, 'show'))->toBeTrue();
    expect(method_exists($endpoint, 'update'))->toBeTrue();
    expect(method_exists($endpoint, 'credits'))->toBeTrue();
    expect(method_exists($endpoint, 'delete'))->toBeTrue();
});

test('applicant endpoint has all required methods', function () {
    $endpoint = $this->client->applicant();

    expect(method_exists($endpoint, 'create'))->toBeTrue();
    expect(method_exists($endpoint, 'show'))->toBeTrue();
    expect(method_exists($endpoint, 'update'))->toBeTrue();
    expect(method_exists($endpoint, 'delete'))->toBeTrue();
});

test('product endpoint has all required methods', function () {
    $endpoint = $this->client->product();

    expect(method_exists($endpoint, 'add'))->toBeTrue();
    expect(method_exists($endpoint, 'addReinclusion'))->toBeTrue();
    expect(method_exists($endpoint, 'removeReinclusion'))->toBeTrue();
});

test('file endpoint has all required methods', function () {
    $endpoint = $this->client->file();

    expect(method_exists($endpoint, 'add'))->toBeTrue();
    expect(method_exists($endpoint, 'remove'))->toBeTrue();
});

test('webhook endpoint has all required methods', function () {
    $endpoint = $this->client->webhook();

    expect(method_exists($endpoint, 'create'))->toBeTrue();
    expect(method_exists($endpoint, 'list'))->toBeTrue();
    expect(method_exists($endpoint, 'delete'))->toBeTrue();
});

test('report endpoint has all required methods', function () {
    $endpoint = $this->client->report();

    expect(method_exists($endpoint, 'show'))->toBeTrue();
    expect(method_exists($endpoint, 'store'))->toBeTrue();
    expect(method_exists($endpoint, 'update'))->toBeTrue();
    expect(method_exists($endpoint, 'print'))->toBeTrue();
    expect(method_exists($endpoint, 'printPdf'))->toBeTrue();
    expect(method_exists($endpoint, 'download'))->toBeTrue();
});
