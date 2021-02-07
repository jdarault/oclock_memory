<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GameController
 * @package App\Controller
 */
class GameController extends AbstractController
{
    /**
     * GameController constructor.
     */
    public function __construct() {

    }

    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        return $this->render('main/homepage.html.twig');
    }

    /**
     * @Route("/play", name="game")
     *
     * @param Request $request
     * @return Response
     */
    public function gameAction(Request $request)
    {
        return $this->render('main/game.html.twig');
    }
}