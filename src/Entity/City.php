<?php

namespace Digilist\GeoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GeoDB compatible city entity
 *
 * @ORM\MappedSuperclass
 */
class City
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(name="country_code", type="string") */
    private $countryCode;

    /** @ORM\Column(type="string") */
    private $city_name;

    /** @ORM\Column(type="string") */
    private $state;

    /**  @ORM\Column(type="string") */
    private $stateShort;

    /** @ORM\Column(type="string") */
    private $adminName2;

    /** @ORM\Column(type="string") */
    private $adminName3;

    /** @ORM\Column(type="point", nullable=true) */
    private $coordinates;

    /** @ORM\Column(name="population", type="integer", nullable=true) */
    private $population;

    /** @ORM\Column(type="string") */
    private $slug;

//    /**
//     * @ORM\OneToMany(targetEntity="ZipCode", mappedBy="city")
//     * @var Collection
//     */
//    private $zipCodes;

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
     * @return string
     */
    public function getAdminName2()
    {
        return $this->adminName2;
    }

    /**
     * @return string
     */
    public function getAdminName3()
    {
        return $this->adminName3;
    }

    /**
     * @return string
     */
    public function getCityName()
    {
        return $this->city_name;
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
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getStateShort()
    {
        return $this->stateShort;
    }


    /**
     * @return ArrayCollection
     */
    public function getZipCodes()
    {
        return $this->zipCodes;
    }

    /**
     * tests whether this city has the asked zip code
     *
     * @param $searchZipCode
     *
     * @return bool
     */
    public function hasZipCode($searchZipCode)
    {
        return $this->getZipCodes()->exists(
            function ($zipCode) use ($searchZipCode) {
                return $zipCode->getZipCode() == $searchZipCode;
            }
        );
    }
}
