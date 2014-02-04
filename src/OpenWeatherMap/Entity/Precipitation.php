<?php
/**
 * Precipitation.php
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
 * Precipitation
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Precipitation
{
    /**
     * The mode value
     *
     * @example "no"
     *
     * @var string|null
     */
    protected $mode;

    /**
     * The value of the precipitation
     *
     * @example 0.5
     *
     * @var float|null
     */
    protected $value;

    /**
     * The type of the precipitation
     *
     * @example "rain"
     *
     * @var string|null
     */
    protected $type;

    /**
     * Return the mode
     *
     * @return string|null
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set the mode
     *
     * @param string|null $mode
     *
     * @return Precipitation
     * @throws InvalidArgumentException
     */
    public function setMode($mode = null)
    {
        if (! is_null($mode)) {
            if (! is_string($mode)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->mode = $mode;
        return $this;
    }

    /**
     * Return the value
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value
     *
     * This method checks that the supplied value is a float.
     * If the supplied value is not a float, this method will attempt
     * to cast the supplied value to a float.
     *
     * If the supplied value is not a float or cannot be cast to a float,
     * this method will throw an InvalidArgumentException
     *
     * @param float|null $value The value to set the value property to
     *
     * @return Precipitation
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            // we cant cast Objects to float
            if (is_object($value)) {
                throw new InvalidArgumentException('Expects a float or a value that can be cast to a float');
            }
            // attempt to cast to float
            if (! is_float($value)) {
                $value = (float)$value;
            }
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Return the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type
     *
     * @param string|null $type
     *
     * @return Precipitation
     * @throws InvalidArgumentException
     */
    public function setType($type = null)
    {
        if (! is_null($type)) {
            if (! is_string($type)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->type = $type;
        return $this;
    }
}
