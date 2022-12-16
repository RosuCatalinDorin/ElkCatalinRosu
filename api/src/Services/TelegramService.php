<?php

namespace App\Services;

use App\Integration\ElasticSearch;
use App\Integration\Telegram;
use \JsonMachine\Items;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TelegramService
{
    private Telegram $telegram;
    private ElasticSearch $elasticSearch;

    public function __construct(Telegram $telegram, ElasticSearch $elasticSearch)
    {

        $this->telegram = $telegram;
        $this->elasticSearch = $elasticSearch;

    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function parseMessage(): array
    {
        return $this->telegram->getTelegramMessanges();
    }

    public function insertMessagesToElk($rows): array
    {

        ini_set('memory_limit','-1');
        ini_set('max_execution_time','-1');
        ini_set('max_input_time','-1');

        $rows = Items::fromFile('bigJson/JsonFILECONVERT.json');

     //   dd($rows);
        foreach ($rows as $row) {

            $result = $this->elasticSearch->insertDocument('hnp-store', $row);

        }
        //dd($value);

        /*      for($i = 0; $i < count($data); $i++) {
                  $data[$i]->date = explode('+',$data[$i]->date)[0];
              }*/
       // $result = $this->elasticSearch->insertDocument('hnp-store', $data);
        return array("ok" => "ok");
    }

}