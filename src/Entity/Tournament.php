<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TournamentRepository::class)
 * 
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="tournament:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="tournament:item"}}},
 *     order={"startingAt"="DESC"},
 *     paginationEnabled=false
 * )
 */
class Tournament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $sport;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $teamsNumber;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $maxPlayersPerTeamNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $startingAt;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="tournaments")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $place;

    /**
     * @ORM\OneToMany(targetEntity=SportMatch::class, mappedBy="tournament")
     */
    #[Groups(['tournament:list', 'tournament:item'])]
    private $sportMatches;

    public function __construct()
    {
        $this->sportMatches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getTeamsNumber(): ?int
    {
        return $this->teamsNumber;
    }

    public function setTeamsNumber(int $teamsNumber): self
    {
        $this->teamsNumber = $teamsNumber;

        return $this;
    }

    public function getMaxPlayersPerTeamNumber(): ?int
    {
        return $this->maxPlayersPerTeamNumber;
    }

    public function setMaxPlayersPerTeamNumber(int $maxPlayersPerTeamNumber): self
    {
        $this->maxPlayersPerTeamNumber = $maxPlayersPerTeamNumber;

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

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection|SportMatch[]
     */
    public function getSportMatches(): Collection
    {
        return $this->sportMatches;
    }

    public function addSportMatch(SportMatch $sportMatch): self
    {
        if (!$this->sportMatches->contains($sportMatch)) {
            $this->sportMatches[] = $sportMatch;
            $sportMatch->setTournament($this);
        }

        return $this;
    }

    public function removeSportMatch(SportMatch $sportMatch): self
    {
        if ($this->sportMatches->removeElement($sportMatch)) {
            // set the owning side to null (unless already changed)
            if ($sportMatch->getTournament() === $this) {
                $sportMatch->setTournament(null);
            }
        }

        return $this;
    }
}
