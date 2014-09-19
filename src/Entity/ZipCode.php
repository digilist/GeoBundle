<?php

namespace Digilist\GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoDB Compatible ZipCode Entity
 *
 * @ORM\MappedSuperclass
 *
 */
class ZipCode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
