<?php

namespace App\Entity;

use App\Repository\SportMatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportMatchRepository::class)
 */
class SportMatch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $firstTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secondTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Field::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $field;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startingAt;

    /**
     * @ORM\ManyToOne(targetEntity=Tournament::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournament;

    /**
     * @ORM\Column(type="time")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $firstTeamScore;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $secondTeamScore;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstTeam(): ?Team
    {
        return $this->firstTeam;
    }

    public function setFirstTeam(?Team $firstTeam): self
    {
        $this->firstTeam = $firstTeam;

        return $this;
    }

    public function getSecondTeam(): ?Team
    {
        return $this->secondTeam;
    }

    public function setSecondTeam(?Team $secondTeam): self
    {
        $this->secondTeam = $secondTeam;

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function getStartingAt(): ?\DateTimeInterface
    {
        return $this->startingAt;
    }

    public function setStartingAt(\DateTimeInterface $startingAt): self
    {
        $this->startingAt = $startingAt;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): self
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getFirstTeamScore(): ?int
    {
        return $this->firstTeamScore;
    }

    public function setFirstTeamScore(?int $firstTeamScore): self
    {
        $this->firstTeamScore = $firstTeamScore;

        return $this;
    }

    public function getSecondTeamScore(): ?int
    {
        return $this->secondTeamScore;
    }

    public function setSecondTeamScore(?int $secondTeamScore): self
    {
        $this->secondTeamScore = $secondTeamScore;

        return $this;
    }
}
