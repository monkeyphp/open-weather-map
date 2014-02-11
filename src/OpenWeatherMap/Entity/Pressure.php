<?php
/**
 * Pressure.php
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
 * Pressure
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Pressure
{
    /**
     *
     * @var string|null
     */
    protected $value;

    /**
     *
     * @var string|null
     */
    protected $unit;

    /**
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value of the pressure
     *
     * @param string|null $value
     *
     * @return Pressure
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (! is_string($value) && !is_numeric($value)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Set the unit value
     *
     * @param string|null $unit
     *
     * @return Pressure
     * @throws InvalidArgumentException
     */
    public function setUnit($unit = null)
    {
        if (! is_null($unit)) {
            if (! is_string($unit)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->unit = $unit;
        return $this;
    }
}
