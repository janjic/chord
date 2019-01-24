<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="postcode_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $postcodeId;

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

    public function getPostcodeId(): ?int
    {
        return $this->postcodeId;
    }

    public function setPostcodeId(int $postcodeId): self
    {
        $this->postcodeId = $postcodeId;

        return $this;
    }


}
