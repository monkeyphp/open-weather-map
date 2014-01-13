<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Entity;
/**
 * Description of Location
 *
 * @author David White <david@monkeyphp.com>
 * 
 * [location] => Array
        (
            [name] => Harrogate
            [type] => Array
                (
                )

            [country] => GB
            [timezone] => Array
                (
                )

            [location] => Array
                (
                    [altitude] => 0
                    [latitude] => 53.99078
                    [longitude] => -1.5373
                    [geobase] => geonames
                    [geobaseid] => 0
                )

        )
 * 
 */
class Location
{   
    protected $name;
    
    protected $type;
    
    protected $country;
    
    protected $timezone;
    
    protected $altitude;
    
    protected $latitude;
    
    protected $longitude;
    
    protected $geobase;
    
    protected $geobaseId;
    
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public function getAltitude()
    {
        return $this->altitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getGeobase()
    {
        return $this->geobase;
    }

    public function getGeobaseId()
    {
        return $this->geobaseId;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
        return $this;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function setGeobase($geobase)
    {
        $this->geobase = $geobase;
        return $this;
    }

    public function setGeobaseId($geobaseId)
    {
        $this->geobaseId = $geobaseId;
        return $this;
    }


}
