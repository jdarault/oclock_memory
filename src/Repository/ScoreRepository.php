<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ScoreRepository
 * @package App\Repository
 */
class ScoreRepository extends ServiceEntityRepository
{
    /**
     * ScoreRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    /**
     * Récupération des dix meilleurs scores en base
     *
     * @return Score[]|array
     */
    public function recupererMeilleursScores() {
        return $this->findBy(array(), array('tempsRealise' => 'ASC'), 10);
    }
}