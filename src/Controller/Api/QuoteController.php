<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Quote;
use App\Provider\QuoteProvider;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/api/quotes/{quoteId}/rate/{type}")
     */
    public function rateQuote(Request $request): JsonResponse
    {
        return $this->json(['quote' => $request->get('quoteId'), 'rate' => $request->get('type')]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/api/quotes/add", methods={"POST"})
     */
    public function addQuote(Request $request): Response
    {
        $content = json_decode($request->getContent(), true);
        if (array_key_exists('content', $content) && !empty($content['content'])) {
            $quote = new Quote();
            $quote->setScore(0);
            $quote->setContent($content['content']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($quote);
            $em->flush();
            $message = ['message' => 'Quote created!', 'quote_id' => $quote->getId()];

            $response = new Response(json_encode($message), 201);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Location', '/api/quotes/'. $quote->getId());
            return $response;
        }
        $message = ['message' => 'Content cannot be empty.'];
        $response = new Response(json_encode($message), 400);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}