<?php
/**
 * Weather.php
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
 * Weather
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Weather
{
    /**
     * The number value of the Weather
     * 
     * @var string|null
     */
    protected $number;
    
    /**
     * The value of the Weather
     * 
     * @var string|null
     */
    protected $value;
    
    /**
     * The icon value
     * 
     * @var string|null
     */
    protected $icon;
    
    /**
     * Return the number of the Weather
     * 
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }
    
    /**
     * Return the value of the Weather
     * 
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the icon value of the Weather
     * 
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the number value of the Weather
     * 
     * @param string|null $number
     * 
     * @return Weather
     * @throws InvalidArgumentException
     */
    public function setNumber($number = null)
    {
        if (! is_null($number)) {
            if (! is_string($number)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->number = $number;
        return $this;
    }
    
    /**
     * Set the value of the Weather
     * 
     * @param string|null $value
     * 
     * @return Weather
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (! is_string($value)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Set the icon value
     * 
     * @param string|null $icon
     * 
     * @return Weather
     * @throws InvalidArgumentException
     */
    public function setIcon($icon = null)
    {
        if (! is_null($icon)) {
            if (! is_string($icon)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->icon = $icon;
        return $this;
    }
}
