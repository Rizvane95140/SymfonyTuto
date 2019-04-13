<?php
/**
 * Created by PhpStorm.
 * User: rizvane
 * Date: 2019-04-11
 * Time: 16:37
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response{
        return new Response($this->renderView('pages\home.html.twig'));
    }
}