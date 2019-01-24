<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busstops
 *
 * @ORM\Table(name="busstops")
 * @ORM\Entity
 */
class Busstops
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
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="decimal", precision=11, scale=8, nullable=false)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="decimal", precision=11, scale=8, nullable=false)
     */
    private $lon;

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

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function setLon($lon): self
    {
        $this->lon = $lon;

        return $this;
    }


}
/**
SELECT latitude, longitude, SQRT( POW(69.1 * (latitude - 57.2377), 2) + POW(69.1 * (-2.26581 - longitude) * COS(latitude / 57.3), 2)) AS distance FROM postcodes HAVING distance < 10 ORDER BY distance LIMIT 0,5

 */

//SELECT SUBSTRING_INDEX(postcode, ' ', 1) as first_part, postcode, latitude, longitude FROM postcodes

//https://gis.stackexchange.com/questions/31628/find-points-within-a-distance-using-mysql
//https://stackoverflow.com/questions/2234204/latitude-longitude-find-nearest-latitude-longitude-complex-sql-or-complex-calc
/**

 *
 * Here latitude = 37 & longitude = -122. So you just pass your own.

SELECT * FROM postcodes ORDER BY ABS(ABS(latitude-57.1766) + ABS(longitude-2.18435)) ASC LIMIT 5

 */


/**
 *
https://stackoverflow.com/questions/2234204/latitude-longitude-find-nearest-latitude-longitude-complex-sql-or-complex-calc

 set @my_lat=34.6087674878572;
 set @my_lng=58.3783670308302;
set @dist=10; #10 miles radius

SELECT dest.id, dest.lat, dest.lng,  3956 * 2 * ASIN(SQRT(POWER(SIN((@my_lat -abs(dest.lat)) * pi()/180 / 2),2) + COS(@my_lat * pi()/180 ) * COS(abs(dest.lat) *  pi()/180) * POWER(SIN((@my_lng - abs(dest.lng)) *  pi()/180 / 2), 2))
) as distance
FROM hotel as dest
having distance < @dist
ORDER BY distance limit 10;
 */

