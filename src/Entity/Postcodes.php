<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postcodes
 *
 * @ORM\Table(name="postcodes")
 * @ORM\Entity
 */
class Postcodes
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
     * @var string|null
     *
     * @ORM\Column(name="postcode", type="string", length=10, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $postcode = 'NULL';

    /**
     * @var float|null
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $latitude = 'NULL';

    /**
     * @var float|null
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $longitude = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }


}
