<?php

namespace App\Services;

use App\Integration\ElasticSearch;

class HnpService
{
    private $elasticSearch;

    public function __construct(ElasticSearch $elasticSearch) {

        $this->elasticSearch = $elasticSearch;
    }
    public function getProducts($data) : callable|array
    {
        return $this->elasticSearch->getDocumentsFromIndex($data);
    }
    public function getProduct($id) : callable|array
    {
        return $this->elasticSearch->getDocumentByID('hnp-store-article',$id);
    }
}