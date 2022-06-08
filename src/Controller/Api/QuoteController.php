<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Quote;
use App\Provider\QuoteProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;

class QuoteController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/api/quotes/page/{pageNumber}/{perPage}', name: 'quotes', methods: ['GET'])]
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
                Response::HTTP_NOT_FOUND
            );
        }
        return $this->json($data);
    }

    #[Route(path: '/api/quotes/{quoteId}', name: 'quote', methods: ['GET'])]
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
                Response::HTTP_NOT_FOUND
            );
        }
        return $this->json($data);
    }

    #[Route(path: '/api/quotes/{quoteId}/rate/{type}')]
    public function rateQuote(Request $request): JsonResponse
    {
        return $this->json(['quote' => $request->get('quoteId'), 'rate' => $request->get('type')]);
    }

    #[Route(path: 'api/quotes/add', methods: ['POST'])]
    public function addQuote(Request $request): Response
    {
        // @todo: deserialize it
        $content = json_decode($request->getContent(), true);
        if (array_key_exists('content', $content) && !empty($content['content'])) {
            $quote = new Quote(Uuid::v4(), $content['content']);
            $this->entityManager->persist($quote);
            $this->entityManager->flush();

            return new JsonResponse(
                [
                    'message' => 'Quote created!',
                    'id' => (string) $quote->getId(),
                    'quote_id' => $quote->getQuoteId(),
                ],
                Response::HTTP_CREATED,
                [
                    'Location' => '/api/quotes/' . $quote->getQuoteId(),
                ]
            );
        }

        return new JsonResponse(
            ['message' => 'Content cannot be empty.'],
            Response::HTTP_BAD_REQUEST
        );
    }
}
