<?php
declare(strict_types=1);

namespace App\UserInterface\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InitialController
 * @package App\Controller
 */
class InitialController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/{route}", name="vue_sub_pages", requirements={"route"="(?!api\b)\b.+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->render('index.html.twig');
    }
}
