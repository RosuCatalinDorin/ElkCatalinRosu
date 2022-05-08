<?php

namespace App\Services;

use App\Integration\ElastiSearch;

class HnpService
{
    private $elasticSearch;

    public function __construct(ElastiSearch $elasticSearch) {

        $this->elasticSearch = $elasticSearch;
    }
    public function getProducts($data) : callable|array
    {
        return $this->elasticSearch->getDocumentsFromIndex($data);
    }
}