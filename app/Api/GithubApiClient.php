<?php

namespace App\Api;

use GuzzleHttp\Client as GClient;

class GithubApiClient extends ApiClient
{
    protected $endpoint = 'https://api.github.com';
}