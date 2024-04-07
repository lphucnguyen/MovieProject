<?php

namespace App\Neo4j;

use Laudis\Neo4j\ClientBuilder;

class Connection
{
    protected $client = null;
    protected $driver = 'bolt';

    protected static $instance = null;
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
                            ->withDefaultDriver('bolt')
                            ->build();

        // if(is_null(self::$instance)){
        //     self::$instance = new Connection();
        // }
        return $this;
    }

    public static function setConnections ($connections, $default = 'bolt')
    {

        self::$client = ClientBuilder::create();

        foreach ($connections as $key => $connection) {
            self::$client
                ->withDriver(
                    $key,
                    $connection
                );
        }

        self::$client->withDefaultDriver($default)->build();

        if (isset($instance)) {
            return self::$instance;
        }
        return new self();
    }

    public function getClient()
    {
        return $this->client;
    }
}
