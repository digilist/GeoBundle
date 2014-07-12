<?php

namespace Digilist\GeoBundle\ORM;

/**
 * Point object for spatial mapping
 */
class Point
{

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param float $x
     */
    public function setLatitude($x)
    {
        $this->latitude = $x;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $y
     */
    public function setLongitude($y)
    {
        $this->longitude = $y;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('POINT(%f %f)', $this->latitude, $this->longitude);
    }
}
