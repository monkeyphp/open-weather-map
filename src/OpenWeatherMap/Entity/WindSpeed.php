<?php
/**
 * WindSpeed.php
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

use InvalidArgumentException;

/**
 * WindSpeed
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindSpeed
{
    /**
     * The nam eof the wind speed
     * 
     * @var string
     */
    protected $name;
    
    /**
     * The value of the wind speed
     * 
     * @var int
     */
    protected $value;
    
    /**
     * Return the name of the Wind speed
     * 
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the wind speed name
     * 
     * @param string $name The name of the wind speed
     * 
     * @throws InvalidArgumentException
     * @return WindSpeed
     */
    public function setName($name = null)
    {
        if (! is_null($name)) {
            if (! is_string($name)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->name = $name;
        return $this;
    }
    
    /**
     * Return the value
     * 
     * @return string|int|null
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Set the value property
     * 
     * @param string|int|float $value The value to set the value property to
     * 
     * @return WindSpeed
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (! is_numeric($value)) {
                throw new InvalidArgumentException('Expects a numeric value');
            }
        }
        $this->value = $value;
        return $this;
    }
    
    /**
     * Return the mps (miles per second) value
     * 
     * @return int|null
     */
    public function getMps()
    {
        return $this->getValue();
    }
    
    /**
     * Set the mps (miles per second) value
     * 
     * @param int|null $mps
     * 
     * @return WindSpeed
     */
    public function setMps($mps = null)
    {
        return $this->setValue($mps);
    }
}
