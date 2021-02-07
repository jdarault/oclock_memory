<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score")
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", nullable=false)
     */
    private $nom;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_jeu", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     * @ORM\Column(name="temps_realise", type="time", nullable=false)
     */
    private $tempsRealise;

    /**
     * Score constructor.
     */
    public function __construct() {
        $this->date = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getTempsRealise(): ?\DateTime
    {
        return $this->tempsRealise;
    }

    /**
     * @param \DateTime $tempsRealise
     */
    public function setTempsRealise(\DateTime $tempsRealise): void
    {
        $this->tempsRealise = $tempsRealise;
    }
}