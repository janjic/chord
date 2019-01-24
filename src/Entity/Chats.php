<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="from", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $from;

    /**
     * @var int
     *
     * @ORM\Column(name="to", type="integer", nullable=false, options={"unsigned"=true})
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

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function setFrom(int $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?int
    {
        return $this->to;
    }

    public function setTo(int $to): self
    {
        $this->to = $to;

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


}
