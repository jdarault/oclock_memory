<?php

namespace App\Controller;

use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class GameController
 * @package App\Controller
 */
class GameController extends AbstractController
{
    /** @var GameService $service */
    private $service;

    /**
     * GameController constructor.
     * @param GameService $service
     */
    public function __construct(GameService $service) {
        $this->service = $service;
    }

    /**
     * Accueil
     *
     * @Route("/", name="homepage")
     *
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        // Récupération des meilleurs scores pour affichage
        $scores = $this->service->recupererMeilleursScores();

        // Création du formulaire pour récupérere le nom du joueur
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => array('class' => 'form-control'),
                'constraints' => [new NotBlank(['message' => 'Avant de jouer, saisis ton nom'])]
            ])
            ->add('play', SubmitType::class, [
                'label' => 'Jouer',
                'attr' => array('class' => '')
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement du nom du joueur en session
            $request->getSession()->set('player_name', $form->getData()['nom']);
            return $this->redirectToRoute('game');
        }

        return $this->render('main/homepage.html.twig', array('scores' => $scores, 'form' => $form->createView()));
    }

    /**
     * Jeu
     *
     * @Route("/play", name="game")
     *
     * @param Request $request
     * @return Response
     */
    public function gameAction(Request $request)
    {
        // Si le joueur n'a pas enregistré son nom, on retourne sur la page d'accueil
        if (!$request->getSession()->has('player_name')) {
            return $this->redirectToRoute('homepage');
        }

        // Initialisation du placement des cartes
        $request->getSession()->set('cartes', $this->service->definirEmplacementCartes());
        // Initialisation du tableau à afficher
        $request->getSession()->set('tableau', $this->service->initialiserTableau());

        $tableau = $this->renderView('partials/tableau.html.twig', array('classe' => $request->getSession()->get('tableau')));

        return $this->render('main/game.html.twig', array('tableau' => $tableau));
    }

    /**
     * Retourne une carte dans le jeu
     *
     * @Route("/play-card", name="play_card")
     *
     * @param Request $request
     * @return Response
     */
    public function retournerCarteAjax(Request $request)
    {
        $carte = $request->request->get('carte');
        $emplacements = $request->getSession()->get('cartes');
        $tableau = $request->getSession()->get('tableau');

        $tableau[$carte] = $emplacements[$carte];
        $request->getSession()->set('tableau', $tableau);

        return $this->render('partials/tableau.html.twig', array('classe' => $tableau));
    }

    /**
     * Annule les deux cartes passées en paramètre
     *
     * @Route("/cancel-cards", name="cancel_cards")
     *
     * @param Request $request
     * @return Response
     */
    public function annulerCartesAjax(Request $request)
    {
        $cartes = explode(',', $request->request->get('cartes'));
        $tableau = $request->getSession()->get('tableau');

        foreach ($cartes as $carte) {
            $tableau[$carte] = 'not-found';
        }

        $request->getSession()->set('tableau', $tableau);

        return $this->render('partials/tableau.html.twig', array('classe' => $tableau));
    }
}