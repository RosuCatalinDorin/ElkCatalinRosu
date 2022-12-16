<?php

namespace App\Integration;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ElasticSearch
{
    private Client $client;

    public function __construct( ParameterBagInterface $parameterBag)
    {
       // dd($parameterBag->get('elk'));
        $this->client = ClientBuilder::create()
                                     ->setHosts([$parameterBag->get('elk')['host']])
                                     ->build();
    }

/*->setHosts(['https://localhost:9200'])
->setBasicAuthentication('elastic', 'password copied during Elasticsearch start')
    */
    public function insertDocument($index, $document): callable|array
    {
        $params = [
            'index' => $index,
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