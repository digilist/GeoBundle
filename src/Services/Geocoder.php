<?php

namespace Digilist\GeoBundle\Services;

use Digilist\GeoBundle\ORM\Point;
use JMS\DiExtraBundle\Annotation\Service;

/**
 *
 * @package Frizeur\PortalBundle\Services
 * @Service("geocoder")
 */
class Geocoder
{

    /**
     * call the geocode-method static
     *
     * @param $address
     *
     * @return array|bool
     */
    public static function geocodeStatic($address)
    {
        $self = new self();

        return $self->geocode($address);
    }

    /**
     * get geo information for the given address (from google)
     *
     * @param $address
     *
     * @return array|bool
     */
    public function geocode($address)
    {
        $requestUrl = 'https://maps.googleapis.com/maps/api/geocode/json?';
        $params = array(
            'sensor' => 'false',
            'language' => 'de',
            'address' => $address,
        );

        $requestUrl .= http_build_query($params);
	
        $json = json_decode(file_get_contents($requestUrl), true);
        $return = array(
            'status' => $json['status'],
            'succeed' => $json['status'] == 'OK',
        );

        if ($json['status'] == 'OK') {
            $result = $json['results'][0];

            $return['formatted_address'] = $result['formatted_address'];
            $return['coordinates'] = new Point($result['geometry']['location']['lat'], $result['geometry']['location']['lng']);

            // find zip code and city name
            $return = array_merge($return, $this->parseAddressComponents($result));

            if (isset($result['partial_match']) && $result['partial_match']) {
                $return['partial_match'] = true;
            }
        }

        return $return;
    }

    /**
     * parse the address components
     * returns the city name and zip code
     *
     * @param array $result
     *
     * @return array
     */
    private function parseAddressComponents(array $result)
    {
        $return = array();
        foreach ($result['address_components'] as $component) {
            foreach ($component['types'] as $type) {
                if ($type == 'locality') {
                    $return['city_name'] = $component['short_name'];
                } else {
                    if ($type == 'postal_code') {
                        $return['zip_code'] = $component['short_name'];
                    }
                }
            }
        }

        return $return;
    }
}
