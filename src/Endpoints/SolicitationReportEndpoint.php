<?php

namespace Accordous\FcAnalise\Endpoints;

/**
 * Class SolicitationReportEndpoint
 *
 * Handles API requests related to solicitation reports.
 */
class SolicitationReportEndpoint extends Endpoint
{
    /**
     * Retrieves a specific solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @return array The API response.
     */
    public function show(int $id): array
    {
        $endpoint = "/solicitation/{$id}/report";

        $response = $this->client->get($endpoint);

        return $response->json();
    }

    /**
     * Stores a new solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @param array $data The data for the new report.
     * @return array The API response.
     */
    public function store(int $id, array $data): array
    {
        $endpoint = "/solicitation/{$id}/report";

        $response = $this->client->post($endpoint, $this->validateData($data, $this->rules()));

        return $response->json();
    }

    /**
     * Updates an existing solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @param array $data The data to update the report with.
     * @return array The API response.
     */
    public function update(int $id, array $data): array
    {
        $endpoint = "/solicitation/{$id}/report";

        $response = $this->client->put($endpoint, $this->validateData($data, $this->rules('PUT')));

        return $response->json();
    }

    /**
     * Generates a printable version of the solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @param string $output The desired output format ('html' or 'pdf'). Defaults to 'html'.
     * @return array The API response.
     */
    public function print(int $id, $output = 'html'): array
    {
        $endpoint = "/solicitation/{$id}/report/print";

        $args = [];

        if ($output === 'pdf') {
            $args['file'] = 'pdf';
        }

        $response = $this->client->get($endpoint, $args);

        return $response->json();
    }

    /**
     * Generates a PDF version of the solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @return array The API response.
     */
    public function printPdf(int $id): array
    {
        return $this->print($id, 'pdf');
    }

    /**
     * Downloads the solicitation report.
     *
     * @param int $id The ID of the solicitation.
     * @param bool $summarized Whether to download a summarized version. Defaults to false.
     * @return array The API response.
     */
    public function download(int $id, bool $summarized = false): array
    {
        $endpoint = "/solicitation/{$id}/report/download";

        $response = $this->client->get($endpoint, [
            'resumido' => $summarized ? 'true' : 'false',
        ]);

        return $response->json();
    }

    /**
     * Defines the validation rules for the endpoint methods.
     *
     * @param string $method The HTTP method ('POST' or 'PUT'). Defaults to 'POST'.
     * @return array An empty array as there are no specific validation rules defined here.
     */
    protected function rules(string $method = 'POST'): array
    {
        return [];
    }
}
