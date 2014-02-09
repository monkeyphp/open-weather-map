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

use InvalidArgumentException;

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
     * The id of the string
     *
     * @var string|null
     */
    protected $id;

    /**
     * The name of the City
     *
     * @var string|null
     */
    protected $name;

    /**
     * Instance of Coord
     *
     * @var Coord|null
     */
    protected $coord;

    /**
     * The country
     *
     * @var string|null
     */
    protected $country;

    /**
     * Instance of Sun
     *
     * @var Sun|null
     */
    protected $sun;

    /**
     * Return the instance of Coord
     *
     * @return Coord|null
     */
    public function getCoord()
    {
        return $this->coord;
    }

    /**
     * Return the country name value
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Return the id of the City
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of the City
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the instance of Sun
     *
     * @return Sun|null
     */
    public function getSun()
    {
        return $this->sun;
    }

    /**
     * Set the Coord instance
     *
     * @param Coord|null $coord
     *
     * @return City
     */
    public function setCoord(Coord $coord = null)
    {
        $this->coord = $coord;
        return $this;
    }

    /**
     * Set the country value
     *
     * @param string|null $country
     *
     * @throws InvalidArgumentException
     * @return City
     */
    public function setCountry($country = null)
    {
        if (! is_null($country)) {
            if (! is_string($country)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->country = $country;
        return $this;
    }

    /**
     * Set the id value
     *
     * @param string|null $id
     *
     * @throws InvalidArgumentException
     * @return City
     */
    public function setId($id = null)
    {
        if (! is_null($id)) {
            if (! ctype_digit((string) $id)) {
                throw new InvalidArgumentException('Expects a numeric string');
            }
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Set the name value
     *
     * @param string|null $name The value to set the name value to
     *
     * @throws InvalidArgumentException
     * @return City
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
     * Set the Sun instance
     *
     * @param Sun|null $sun The instance of Sun
     *
     * @return City
     */
    public function setSun(Sun $sun = null)
    {
        $this->sun = $sun;
        return $this;
    }
}
