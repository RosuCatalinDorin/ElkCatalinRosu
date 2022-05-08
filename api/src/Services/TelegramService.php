<?php
namespace App\Services;

use App\Integration\ElastiSearch;
use App\Integration\Telegram;
use DateTime;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TelegramService
{
    private Telegram $telegram;
    private ElastiSearch $elasticSearch;

    public function __construct(Telegram $telegram, ElastiSearch $elasticSearch)
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
    public function parseMessage() : array
    {
      return  $this->telegram->getTelegramMessanges();
    }
    public function insertMessagesToElk ($data)
    {

        //data->date  = DateTime::createFromFormat('Y-m-d H:i:s', explode('+',$data->date)[0]);


        for($i = 0; $i < count($data); $i++) {
            $data[$i]->date =explode('+',$data[$i]->date)[0];
        }
        $this->elasticSearch->updateBuulk('mr-crypto',$data);

        return array("ok"=>"ok");
    }

}