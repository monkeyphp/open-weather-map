<?php
/**
 * Coord.php
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
 * Coord
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Coord
{
    /**
     *
     * @var string
     */
    protected $latitude;
    
    /**
     *
     * @var string
     */
    protected $longitude;
    
    /**
     * 
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * 
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the latitude
     * 
     * @param string $latitude
     * 
     * @return Coord
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }
    
    /**
     * Set the longitude
     * 
     * @param string $longitude
     * 
     * @return Coord
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }
}
