<?php

namespace App\Api;

use GuzzleHttp\Client as GClient;

abstract class ApiClient
{
    protected $client   = null;
    protected $endpoint = null;

    public function __construct()
    {
        $this->client = new GClient([
            'base_uri' => $this->endpoint,
            'headers'  => [
                'Accept' => 'application/vnd.github.v3+json',
            ],
        ]);
    }

    public function get($path)
    {
        $ret = $this->client->get($path);
        return json_decode($ret->getBody());
    }
}