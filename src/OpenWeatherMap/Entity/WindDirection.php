<?php
/**
 * WindDirection.php
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
 * WindDirection
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindDirection
{
    /**
     * The value of the wind direction
     * 
     * @var float
     */
    protected $value;
    
    /**
     * The code of the wind direction
     * 
     * @var string
     */
    protected $code;
    
    /**
     * The name of the wind direction
     * 
     * @var string
     */
    protected $name;
    
    /**
     * Return the value of the wind direction
     * 
     * @return float|null
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Return the code of the wind direction
     * 
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Return the name of the wind direction
     * 
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value property of the wind direction
     * 
     * @param string|int|float $value The value to set the value property to
     * 
     * @return WindDirection
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (! is_numeric($value)) {
                throw new InvalidArgumentException('Expects a numeric');
            }
        }
        $this->value = $value;
        return $this;
    }
    
    /**
     * Set the code property of the wind direction
     * 
     * @param string $code The value to set the code to
     * 
     * @return WindDirection
     * @throws InvalidArgumentException
     */
    public function setCode($code = null)
    {
        if (! is_null($code)) {
            if (! is_string($code)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->code = $code;
        return $this;
    }

    /**
     * Set the name property of the wind direction
     * 
     * @param string|null $name The value to set the name property to
     * 
     * @return WindDirection
     * @throws InvalidArgumentException
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
}
