<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="team")
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity=SportMatch::class, mappedBy="firstTeam")
     */
    private $sportMatches;

    public function __construct()
    {
        $this->player = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(User $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(User $player): self
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

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
            $sportMatch->setFirstTeam($this);
        }

        return $this;
    }

    public function removeSportMatch(SportMatch $sportMatch): self
    {
        if ($this->sportMatches->removeElement($sportMatch)) {
            // set the owning side to null (unless already changed)
            if ($sportMatch->getFirstTeam() === $this) {
                $sportMatch->setFirstTeam(null);
            }
        }

        return $this;
    }
}
