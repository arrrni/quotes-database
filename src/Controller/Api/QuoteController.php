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
     * @Route("/api/quotes/page/{pageNumber}/{perPage}", name="quotes", methods={"GET"})
     */
    public function getQuotes(Request $request, QuoteProvider $provider): JsonResponse
    {
        $data = $provider->getAllQuotes(
            (int)$request->get('perPage', 20),
            (int)$request->get('pageNumber', 1)
        );
        if (null === $data) {
            return $this->json(
                [
                    'error' => 'No quotes found.'
                ],
                404
            );
        }
        return $this->json($data);
    }

    /**
     * @param Request $request
     * @param QuoteProvider $provider
     * @return JsonResponse
     * @Route("/api/quotes/{quoteId}", name="quote", methods={"GET"})
     */
    public function getQuote(Request $request, QuoteProvider $provider): JsonResponse
    {
        $data = $provider->getQuote((int)$request->get('quoteId'));
        if (null === $data) {
            return $this->json(
                [
                    'error' => sprintf(
                        'Quote ID %s not found.',
                        $request->get('quoteId')
                    )
                ],
                404
            );
        }
        return $this->json($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api/quotes/{quoteId}/rate")
     */
    public function rateQuote(Request $request): JsonResponse
    {
        return $this->json(['quote' => $request->get('quoteId')]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addQuote(Request $request): JsonResponse
    {
        return $this->json([$request->request->all()]);
    }
}
