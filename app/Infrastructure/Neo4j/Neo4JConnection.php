<?php

namespace App\Infrastructure\Neo4j;

use Laudis\Neo4j\ClientBuilder;

class Neo4JConnection implements INeo4JConnection
{
    protected $client;
    protected $driver;

    protected $connections = [
        'bolt' => 'neo4j+s://neo4j:S2RO6DPey4VKT_lJ1F5aC6AFAuXsVGtRUmCFHJgF5Xo@e2c52ea5.databases.neo4j.io'
    ];

    public function __construct()
    {
        $this->client = ClientBuilder::create();

        foreach ($this->connections as $key => $connection) {
            $this->client = $this->client
                                    ->withDriver(
                                        $key,
                                        $connection
                                    );
        }

        $this->client = $this->client
                            ->withDefaultDriver($this->driver)
                            ->build();
    }

    public function setConnections ($connections, $default = 'bolt')
    {
        $this->client = ClientBuilder::create();

        foreach ($connections as $key => $connection) {
            $this->client
                ->withDriver(
                    $key,
                    $connection
                );
        }

        $this->client->withDefaultDriver($default)->build();

        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }
}
