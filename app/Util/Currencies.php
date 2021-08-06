<?php
namespace App\Util;

use GuzzleHttp\Client;

class Currencies
{
    /**
     * Guzzle client.
     *
     * @var string
     */
    protected $client;

    /**
     * App_id currencies service.
     *
     * @var string
     */
    protected $app_id;

    /**
     *
     * Currencies constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->app_id = env('CURRENCY_APP_ID');
    }

    /**
     *
     * fetch data from currency service
     *
     * @param $base nullable string Change base currency (3-letter code, default: USD)
     * @param $symbols nullable string Limit results to specific currencies (comma-separated list of 3-letter codes)
     * @param $prettyprint nullable boolean Set to false to reduce response size (removes whitespace)
     * @param $prettyprint nullable boolean Extend returned values with alternative, black market and digital currency rates
     *
     * @return object
     */
    public function fetch($base = '', $symbols = '', $prettyprint = false, $show_alternative = true)
    {
        $params = [
            'query' => [
                'app_id' => $this->app_id,
            ]
        ];

        if (!empty($base)) {
            $params['query']['base'] = $base;
        }

        if (!empty($symbols)) {
            $params['query']['symbols'] = $symbols;
        }

        if (($prettyprint != false)) {
            $params['query']['prettyprint'] = $prettyprint;
        }

        if (($show_alternative != false)) {
            $params['query']['show_alternative'] = $show_alternative;
        }

        return $this->endpointRequest('/latest.json', $params);
    }

    /**
     *
     * endpointRequest
     *
     * @param $base requested uri
     * @param $symbols get params array
     *
     * @return object
     */
    protected function endpointRequest($uri, $params = [])
    {
        try {
            $response = $this->client->request('GET', $uri, $params);
        } catch (\Exception $e) {
                return $e->getCode();
        }

        return $this->responseHandler($response->getBody()->getContents());
    }

    /**
     *
     * responseHandler
     *
     * @param $response
     *
     * @return object
     */
    protected function responseHandler($response)
    {
        if ($response) {
            return json_decode($response);
        }

        return [];
    }
}