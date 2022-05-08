<?php

namespace App\Integration;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElastiSearch
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
                                     ->setHosts(['http://elastic:muiepariuri1@localhost:9200'])
                                     ->build();
    }

    public function insertDocument($imdex, $document)
    {
        $params = [
            'index' => $imdex,
            'id' => $document->id,
            'body' => $document
        ];
        $this->client->index($params);
    }

    public function updateBuulk($imdex, $data)
    {

        for($i = 0; $i < count($data); $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => $imdex,
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

        //dd($data);
        //echo '<br>';
       // print_r((array) $data );

        return $this->client->search((array) $data);
    }
}