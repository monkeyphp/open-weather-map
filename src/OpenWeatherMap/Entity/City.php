<?php
/**
 * City.php
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
 * City
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class City
{
    /**
     *
     * @var string
     */
    protected $id;
    
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var Coord
     */
    protected $coord;
    
    /**
     *
     * @var string
     */
    protected $country;
    
    /**
     *
     * @var Sun
     */
    protected $sun;
    
    /**
     * 
     * @return Coord
     */
    public function getCoord()
    {
        return $this->coord;
    }
    
    /**
     * 
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * 
     * @return Sun
     */
    public function getSun()
    {
        return $this->sun;
    }
    
    /**
     * Set the Coord instance
     * 
     * @param Coord $coord
     * 
     * @return City
     */
    public function setCoord(Coord $coord)
    {
        $this->coord = $coord;
        return $this;
    }
    
    /**
     * Set the country value
     * 
     * @param string $country
     * 
     * @return City
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
    
    /**
     * Set the id value
     * 
     * @param string $id
     * 
     * @return City
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Set the name value
     * 
     * @param string $name
     * 
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Set the Sun instance
     * 
     * @param Sun $sun
     * 
     * @return City
     */
    public function setSun($sun)
    {
        $this->sun = $sun;
        return $this;
    }
}
