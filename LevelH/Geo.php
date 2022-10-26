<?php

namespace Hackathon\LevelH;

class Geo
{
    public function __construct()

    {

    }

    public function getClosestCityFromId($id){
        $myCities = new CitiesData();
        $cities = $myCities->getCities();
        $srcCity = $myCities->getCityInfoById($id);
        $closestDistance = PHP_INT_MAX;
        $closestCity = $srcCity;
        $rlo1 = deg2rad($srcCity['lat']);
        $rla1 = deg2rad($srcCity['long']);
        $cosDeg2RadLat1 = cos(deg2rad($srcCity['lat']));
        $earth_radius = 6378137; // Earth Radius is 6378.137 km

        foreach($cities as $dstCity) {

            if($dstCity['id'] === $srcCity['id']) {
                continue;
            }

            if($dstCity['lat'] >= $srcCity['lat']+1 || $dstCity['lat'] <= $srcCity['lat']-1 &&
            $dstCity['long'] >= $srcCity['long']+1 || $dstCity['long'] <= $srcCity['long']-1) {
                continue;
            }

            $distance = $this->computeDistance(
                $rlo1,
                $rla1,
                $dstCity['lat'],
                $dstCity['long'],
                $cosDeg2RadLat1,
                $earth_radius
            );
            
            if ($closestDistance > $distance) {
                $closestDistance = $distance;
                $closestCity = $dstCity;
            }
        }

        return $closestCity;

    }

    /**
     * Give the distance in meter between two points (in kilometer)
     *
     * @param $rlo1
     * @param $rla2
     * @param $lat2
     * @param $lng2
     * @return int
     */

    private function computeDistance($rla1, $rlo1, $lat2, $lng2, $cosDeg2RadLat1, $earth_radius){
        
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a =
            (sin($dla) * sin($dla)) +
            cos($rla1) * cos($rla2) *
            (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return ($earth_radius * $d) / pow(10, 3);
    }
};