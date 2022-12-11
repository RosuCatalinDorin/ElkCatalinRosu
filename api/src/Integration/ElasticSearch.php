<?php

namespace App\Integration;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticSearch
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
                                     ->setHosts(['http://elastic:muiepariuri1@elk_kibana-elasticsearch-1:9200'])
                                     ->build();
    }

    public function insertDocument($imdex, $document): callable|array
    {
        $params = [
            'index' => $imdex,

            'body' => $document
        ];
        return $this->client->index($params);
    }

    public function updateBulk($index, $data): void
    {
        $params = [];
        for($i = 0; $i < count($data); $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => $index,
                    '_id' => $data[$i]->id
                ]
            ];
            $params['body'][] = $data[$i];
        }
        $this->client->bulk($params);
    }

    public function getDocumentsFromIndex($data) : callable|array
    {
        /*        $params = [
            'index' => "hnp-shop",
            'body'  => [
                'query' => [
                    'match' => [
                        'UDX_APPAREA' => 'Threading'
                    ]
                ]
            ]
        ];*/
        return $this->client->search((array) $data);
    }
}