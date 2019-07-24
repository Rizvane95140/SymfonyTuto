<?php
/**
 * Created by PhpStorm.
 * User: Rizvane
 * Date: 2019-04-11
 * Time: 16:37
 */

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response {
        $properties = $repository->findLatest();
        return new Response($this->renderView('pages\home.html.twig', [
            'properties' => $properties
        ]));
    }


}