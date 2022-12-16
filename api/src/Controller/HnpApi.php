<?php
namespace App\Controller;
use App\Services\TelegramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use App\Services\HnpService;

class HnpApi extends AbstractController
{
    private TelegramService $telegramService;
    private HnpService $hnpService;

    public function __construct(TelegramService $telegramService,HnpService $hnpService)
    {
        $this->telegramService =  $telegramService;
        $this->hnpService = $hnpService;
    }


    /**
     * @Route("hnp/elk/data", name="elcGetData", stateless=true,methods={"POST"})
     */
    public function elcGetData (Request $request): Response
    {
        try {
            $data = json_decode($request->getContent());
            return $this->json($this->hnpService->getProducts($data));
        } catch (ClientExceptionInterface $e) {
            return $this->json(['ups'=>"error",'mess'=>$e->getMessage()]);
        }
    }
}

