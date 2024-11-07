<?php

namespace App\Services\HTTPClient;

interface IHTTPClientService
{
    public function setBody(array $body);

    public function setHeaders(array $headers);

    public function setOptions(array $options);

    public function setUrl(string $url);

    public function get();

    public function post();

    public function put();

    public function delete();
}
