<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class QuoteController
 * @package App\Controller\Api
 */
class QuoteController extends Controller
{
    public function getQuotes(Request $request): JsonResponse
    {
        return $this->json(['test'=>'OK']);
    }
}
