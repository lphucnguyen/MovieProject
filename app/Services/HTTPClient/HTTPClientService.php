<?php

namespace App\Services\HTTPClient;

class HTTPClientService implements IHTTPClientService
{
    private string $url;
    private array $headers;
    private array $body;
    private array $options;

    public function setBody(array $body)
    {
        $this->body = $body;

        return $this;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function get()
    {
        // Logic to make a GET request
    }

    public function post()
    {
        // Logic to make a POST request
    }

    public function put()
    {
        // Logic to make a PUT request
    }

    public function delete()
    {
        // Logic to make a DELETE request
    }
}
