<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Houses
 *
 * @ORM\Table(name="houses")
 * @ORM\Entity
 */
class Houses
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
     * @ManyToOne(targetEntity="Postcodes")
     * @JoinColumn(name="postcode_id", referencedColumnName="id", nullable=false)
     */
    private $postcode;

    /**
     * @ManyToOne(targetEntity="Addresses")
     * @JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     */
    private $address;

    /**
     * @var bool
     *
     * @ORM\Column(name="propertytype", type="boolean", nullable=false)
     */
    private $propertytype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="date", nullable=false)
     */
    private $updated;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropertytype(): ?bool
    {
        return $this->propertytype;
    }

    public function setPropertytype(bool $propertytype): self
    {
        $this->propertytype = $propertytype;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getPostcode(): ?Postcodes
    {
        return $this->postcode;
    }

    public function setPostcode(?Postcodes $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getAddress(): ?Addresses
    {
        return $this->address;
    }

    public function setAddress(?Addresses $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

}
