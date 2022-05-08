<?php
namespace App\Controller;
use App\Services\TelegramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;


class SaveData extends AbstractController
{
    private TelegramService $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService =  $telegramService;
    }

    /**
     * @Route("save/telegram/channels", name="saveMasseg", stateless=true)
     */
    public function addContact (Request $request): Response
    {
        try {
            $data = $request->getContent();
            return $this->json($this->telegramService->insertMessagesToElk($data));
        } catch (ClientExceptionInterface $e) {
            return $this->json(['ups'=>"error",'mess'=>$e->getMessage()]);
        }
    }
}

