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
     *
     * @var string|null
     */
    protected $mode;

    /**
     *
     * @var string|null
     */
    protected $value;

    /**
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
     * @param string $mode
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
     * Return the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value
     *
     * @param string|null $value
     *
     * @return Precipitation
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (! is_string($value)  && !is_numeric($value)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->value = $value;
        return $this;
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
            if (! is_string($type)  && !is_numeric($type)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->type = $type;
        return $this;
    }
}
