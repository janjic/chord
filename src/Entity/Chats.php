<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Chats
 *
 * @ORM\Table(name="chats")
 * @ORM\Entity
 */
class Chats
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
     * @JoinColumn(name="from", referencedColumnName="id")
     */
    private $from;

    /**
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="from", referencedColumnName="id")
     */
    private $to;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="seendate", type="datetime", nullable=false)
     */
    private $seendate;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSeendate(): ?\DateTimeInterface
    {
        return $this->seendate;
    }

    public function setSeendate(\DateTimeInterface $seendate): self
    {
        $this->seendate = $seendate;

        return $this;
    }

    public function getFrom(): ?Users
    {
        return $this->from;
    }

    public function setFrom(?Users $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?Users
    {
        return $this->to;
    }

    public function setTo(?Users $to): self
    {
        $this->to = $to;

        return $this;
    }
    


}
