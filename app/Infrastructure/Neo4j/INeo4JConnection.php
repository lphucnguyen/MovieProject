<?php

namespace App\Infrastructure\Neo4j;

interface INeo4JConnection {
    public function getClient();
    public function setConnections($connections, $default = 'bolt');
}