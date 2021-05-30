<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\FieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FieldRepository::class)
 * 
 *  @Annotation (
 *      "place"={
 *          "name": "Place",
 *          "type": "collection",
 *          "entity": "places"
 *      }
 * )
 * 
 *  @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="field:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="field:item"}}},
 *     order={"name"="DESC"},
 *     paginationEnabled=false
 * )
 */
class Field
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['field:list', 'field:item'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['field:list', 'field:item'])]
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="fields")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['field:list', 'field:item'])]
    private $place;

    /**
     * @ORM\OneToMany(targetEntity=SportMatch::class, mappedBy="field")
     */
    #[Groups(['field:list', 'field:item'])]
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
            $sportMatch->setField($this);
        }

        return $this;
    }

    public function removeSportMatch(SportMatch $sportMatch): self
    {
        if ($this->sportMatches->removeElement($sportMatch)) {
            // set the owning side to null (unless already changed)
            if ($sportMatch->getField() === $this) {
                $sportMatch->setField(null);
            }
        }

        return $this;
    }
}
