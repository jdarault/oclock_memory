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
}