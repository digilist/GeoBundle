<?php

namespace Digilist\GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geodb
 *
 * @ORM\Table(name="geodb_zip_codes")
 * @ORM\Entity
 */
class ZipCode
{

    /** @ORM\Column(type="string") */
    private $zipCode;

    /** @ORM\Column(type="point", nullable=true) */
    private $coordinates;

    /** @ORM\Column(type="string", nullable=true) */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="zip_codes")
     */
    private $city;

    /**
     * @return \Digilist\GeoBundle\ORM\Point
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }
}
