<?php
namespace App\Integration;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Telegram
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     */
    public function getTelegramMessanges(): array
    {
        $response = $this->client->request(
            'GET',
            'http://192.168.0.221:8081/api'
        );
        $statusCode = $response->getStatusCode();
        return $response->toArray();
    }

}