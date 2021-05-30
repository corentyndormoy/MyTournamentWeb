<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 *  @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="user:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="user:item"}}},
 *     order={"firstName"="DESC"},
 *     paginationEnabled=false
 * )
 */
class User
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
    #[Groups(['user:list', 'user:item'])]
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['user:list', 'user:item'])]
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['user:list', 'user:item'])]
    private $mail;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    #[Groups(['user:list', 'user:item'])]
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['user:list', 'user:item'])]
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['user:list', 'user:item'])]
    private $password;

    /**
     * @ORM\Column(type="string", length=1)
     */
    #[Groups(['user:list', 'user:item'])]
    private $gender;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['user:list', 'user:item'])]
    private $playerNumber;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(['user:list', 'user:item'])]
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="player")
     */
    #[Groups(['user:list', 'user:item'])]
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPlayerNumber(): ?int
    {
        return $this->playerNumber;
    }

    public function setPlayerNumber(?int $playerNumber): self
    {
        $this->playerNumber = $playerNumber;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
