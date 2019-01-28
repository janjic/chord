<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=80, nullable=false, options={"default"="''"})
     */
    private $surname = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false, options={"default"="''"})
     */
    private $email = '\'\'';

    /**
     *@ORM\Column(type="integer", options={"default":0})
     */
    protected $numLGiven;

    /**
     *@ORM\Column(type="integer", options={"default":0})
     */
    protected $numLReceived;

    /**
     *@ORM\Column(type="integer", options={"default":0})
     */
    protected $numMatches;

    /**
     *@ORM\Column(type="integer", options={"default":0})
     */
    protected $numChats;

    /**
     *@ORM\Column(type="integer", options={"default":0})
     */
    protected $numAnwMsg;

    /**
     *@ORM\Column(type="text", options={"default":""})
     */
    protected $likeIds;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


}
