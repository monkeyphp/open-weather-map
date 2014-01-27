<?php
/**
 * Location.php
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 *
 * Copyright (C) 2014  David White
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see [http://www.gnu.org/licenses/].
 */
namespace OpenWeatherMap\Entity;

/**
 * Location
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
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
