<?php
/**
 * Humidity.php
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
 * Humidity
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Humidity
{
    /**
     * The value of the humidity
     *
     * @var int|null
     */
    protected $value;

    /**
     * The unit of measurement
     *
     * @example "%"
     *
     * @var string|null
     */
    protected $unit;

    /**
     * Return the value of the Humidity
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the unit of measurement
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value of the Humidity
     *
     * @param int|null $value
     *
     * @return Humidity
     */
    public function setValue($value = null)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Set the unit of measurement
     *
     * @param string|null $unit
     *
     * @return Humidity
     */
    public function setUnit($unit = null)
    {
        $this->unit = $unit;
        return $this;
    }
}
