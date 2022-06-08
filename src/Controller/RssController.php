<?php

declare(strict_types=1);

namespace App\Controller;

use App\Provider\RssFeedProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RssController extends AbstractController
{
    #[Route(path: '/api/feed', name: 'rss')]
    public function __invoke(Request $request, RssFeedProvider $provider): Response
    {
        return new Response(
            $provider->getFeed(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/rss+xml',
            ]
        );
    }
}
