<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Houses
 *
 * @ORM\Table(name="houses", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
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
     * @var int
     *
     * @ORM\Column(name="postcode_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $postcodeId;

    /**
     * @var int
     *
     * @ORM\Column(name="address_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $addressId;

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
     * @var \Users
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

    public function getPostcodeId(): ?int
    {
        return $this->postcodeId;
    }

    public function setPostcodeId(int $postcodeId): self
    {
        $this->postcodeId = $postcodeId;

        return $this;
    }

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): self
    {
        $this->addressId = $addressId;

        return $this;
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
