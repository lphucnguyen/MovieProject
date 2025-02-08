<?php

namespace App\Shared\Domain\Models;

use InvalidArgumentException;
use Laudis\Neo4j\Client;
use Laudis\Neo4j\ClientBuilder;

class NeoModel implements INeoModel
{
    private Client $client;
    protected string $label = '';
    protected string $keyField = 'id';

    public function __construct()
    {
        $client = ClientBuilder::create();

        $client = $client->withDriver("bolt", sprintf(
            "neo4j+s://%s:%s@%s",
            env("NEO4J_USERNAME"),
            env("NEO4J_PASSWORD"),
            env("NEO4J_HOST")
        ));

        $this->client = $client->withDefaultDriver("bolt")->build();
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function create(array $properties)
    {
        if (empty($this->label)) {
            throw new InvalidArgumentException('Node label must be specified.');
        }

        $cypher = "CREATE (n:{$this->label} " . $this->formatPropertiesToCreate($properties) . ") RETURN n";

        return $this->client->run($cypher, $properties)->getResults();
    }

    public function update(string $keyValue, array $properties)
    {
        if (empty($this->label)) {
            throw new InvalidArgumentException('Node label must be specified.');
        }

        $updateQuery = $this->formatPropertiesToUpdate($properties);
        $cypher = "MATCH (n:$this->label { $this->keyField: \$$this->keyField })
                   SET $updateQuery
                   RETURN n";

        $params = array_merge(
            [
                $this->keyField => $keyValue
            ],
            $properties
        );

        return $this->client->run($cypher, $params)->getResults();
    }

    public function delete(string $keyValue)
    {
        if (empty($this->label)) {
            throw new InvalidArgumentException('Node label must be specified.');
        }

        $cypher = "MATCH (n:$this->label { $this->keyField: \$$this->keyField })
                    DETACH DELETE n";

        $params = [$this->keyField => $keyValue];
        $this->client->run($cypher, $params);
    }

    private function formatPropertiesToUpdate(array $properties)
    {
        $updateClauses = [];
        foreach ($properties as $key => $value) {
            $updateClauses[] = "n.$key = \$$key";
        }
        return implode(', ', $updateClauses);
    }

    private function formatPropertiesToCreate(array $properties)
    {
        $props = array_map(fn($key) => "$key: \$$key", array_keys($properties));
        return '{ ' . implode(', ', $props) . ' }';
    }
}
