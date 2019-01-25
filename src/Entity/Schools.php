<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Schools
 *
 * @ORM\Table(name="schools")
 * @ORM\Entity
 */
class Schools
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @ManyToOne(targetEntity="Postcodes")
     * @JoinColumn(name="postcode_id", referencedColumnName="id",  nullable=true)
     */
    private $postcode;

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

    public function getPostcode(): ?Postcodes
    {
        return $this->postcode;
    }

    public function setPostcode(?Postcodes $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }


}
