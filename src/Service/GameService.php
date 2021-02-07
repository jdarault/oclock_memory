<?php

namespace App\Service;

use App\Entity\Score;
use App\Repository\ScoreRepository;

/**
 * Class GameService
 * @package App\Service
 */
class GameService
{
    /** @var ScoreRepository $repository */
    protected $repository;

    private $cartesAJouer = [
        'pomme-rouge', 'pomme-rouge',
        'banane', 'banane',
        'orange', 'orange',
        'citron-vert', 'citron-vert',
        'grenade', 'grenade',
        'abricot', 'abricot',
        'citron-jaune', 'citron-jaune',
        'fraise', 'fraise',
        'pomme-verte', 'pomme-verte',
        'peche', 'peche',
        'raisin', 'raisin',
        'pasteque', 'pasteque',
        'prune', 'prune',
        'poire', 'poire',
        'griotte', 'griotte',
        'framboise', 'framboise',
        'mangue', 'mangue',
        'cerise-jaune', 'cerise-jaune'
    ];

    /**
     * GameService constructor.
     * @param ScoreRepository $repository
     */
    public function __construct(ScoreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Récupération des dix meilleurs scores en base
     *
     * @return Score[]|array
     */
    public function recupererMeilleursScores() {
        return $this->repository->recupererMeilleursScores();
    }

    /**
     * Définit l'emplacement des cartes aléatoirement
     *
     * @return array
     */
    public function definirEmplacementCartes() {
        // Mélange aléatoirement le tableau de carte
        shuffle($this->cartesAJouer);

        // Placement des cartes dans le jeu
        $i = 1;
        $jeu = array();
        foreach ($this->cartesAJouer as $carte) {
            $jeu['c' . $i] = $carte;
            $i++;
        }

        return $jeu;
    }

    /**
     * Initialise le jeu à afficher
     * @return array
     */
    public function initialiserTableau() {
        // Initialise les cartes face cachée
        $jeu = array();
        for ($i = 1; $i <= sizeof($this->cartesAJouer); $i++) {
            $jeu['c' . $i] = 'not-found';
        }

        return $jeu;
    }
}