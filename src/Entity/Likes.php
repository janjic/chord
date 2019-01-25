<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity
 */
class Likes
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
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="a", referencedColumnName="id")
     */
    private $a;

    /**
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="b", referencedColumnName="id")
     */
    private $b;

    /**
     * @var bool
     *
     * @ORM\Column(name="like", type="boolean", nullable=false)
     */
    private $like;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLike(): ?bool
    {
        return $this->like;
    }

    public function setLike(bool $like): self
    {
        $this->like = $like;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getA(): ?Users
    {
        return $this->a;
    }

    public function setA(?Users $a): self
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?Users
    {
        return $this->b;
    }

    public function setB(?Users $b): self
    {
        $this->b = $b;

        return $this;
    }


}
