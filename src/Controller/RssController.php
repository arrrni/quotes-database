<?php
declare(strict_types=1);

namespace App\Controller;

use App\Provider\RssFeedProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RssController
 * @package App\Controller
 */
class RssController extends Controller
{
    /**
     * @Route("/rss", name="rss")
     * @param Request $request
     * @param RssFeedProvider $provider
     * @return Response
     */
    public function __invoke(Request $request, RssFeedProvider $provider)
    {
        $response = new Response($provider->getFeed());
        $response->headers->set('Content-Type', 'application/rss+xml');
        return $response;
    }
}