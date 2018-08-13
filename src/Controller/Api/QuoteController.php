<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Provider\QuoteProvider;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class QuoteController
 * @package App\Controller\Api
 */
class QuoteController extends Controller
{
    /**
     * @param Request $request
     * @param QuoteProvider $provider
     * @return JsonResponse
     * @Route("/api/quotes", name="quotes", methods={"GET"})
     */
    public function getQuotes(Request $request, QuoteProvider $provider): JsonResponse
    {
        dump($provider->getAllQuotes());die;
        return $this->json($provider->getAllQuotes());
    }
}
