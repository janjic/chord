<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity
 */
class Addresses
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
     * @JoinColumn(name="postcode_id", referencedColumnName="id")
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=60, nullable=false)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=60, nullable=false)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=60, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=60, nullable=false)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="site_number", type="string", length=20, nullable=false)
     */
    private $siteNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="site_description", type="string", length=60, nullable=false)
     */
    private $siteDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="site_subdescription", type="string", length=60, nullable=false)
     */
    private $siteSubdescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getSiteNumber(): ?string
    {
        return $this->siteNumber;
    }

    public function setSiteNumber(string $siteNumber): self
    {
        $this->siteNumber = $siteNumber;

        return $this;
    }

    public function getSiteDescription(): ?string
    {
        return $this->siteDescription;
    }

    public function setSiteDescription(string $siteDescription): self
    {
        $this->siteDescription = $siteDescription;

        return $this;
    }

    public function getSiteSubdescription(): ?string
    {
        return $this->siteSubdescription;
    }

    public function setSiteSubdescription(string $siteSubdescription): self
    {
        $this->siteSubdescription = $siteSubdescription;

        return $this;
    }

    public function getPostcode(): ?Users
    {
        return $this->postcode;
    }

    public function setPostcode(?Users $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

}
