<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class InitialController extends AbstractController
{
    #[
        Route(path: '/', name: 'homepage'),
        Route(path: '/{route}', name: 'vue_sub_pages', requirements: ['route' => '(?!api\b)\b.+"'])
    ]
    public function __invoke(Request $request): Response
    {
        return $this->render('index.html.twig');
    }
}
