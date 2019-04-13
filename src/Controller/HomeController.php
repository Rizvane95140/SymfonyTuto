<?php
/**
 * Created by PhpStorm.
 * User: rizvane
 * Date: 2019-04-11
 * Time: 16:37
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController{

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): Response{
        return new Response($this->twig->render('pages\home.html.twig'));
    }
}