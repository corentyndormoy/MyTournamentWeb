<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SportMatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportMatchRepository::class)
 * 
 *  @Annotation (
 *      "team"={
 *          "name": "Team",
 *          "type": "collection",
 *          "entity": "teams"
 *      }
 * )
 * 
 *  @Annotation (
 *      "field"={
 *          "name": "Field",
 *          "type": "collection",
 *          "entity": "fields"
 *      }
 * )
 *
 * 
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="sport-match:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="sport-match:item"}}},
 *     order={"startingAt"="DESC"},
 *     paginationEnabled=false
 * )
 */
class SportMatch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $firstTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $secondTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Field::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $field;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $startingAt;

    /**
     * @ORM\ManyToOne(targetEntity=Tournament::class, inversedBy="sportMatches")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $tournament;

    /**
     * @ORM\Column(type="time")
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
    private $firstTeamScore;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['sport-match:list', 'sport-match:item'])]
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
