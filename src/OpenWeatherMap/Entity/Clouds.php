<?php
/**
 * Clouds.php
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
 * Clouds
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Clouds
{
    /**
     *
     * @var string
     */
    protected $value;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $all;

    /**
     * The unit of measurement
     *
     * @example "%"
     *
     * @var string|null
     */
    protected $unit;

    /**
     * Return the value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the name value
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value
     *
     * @param string $value
     *
     * @return Clouds
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Set the name value
     *
     * @param string $name
     *
     * @return Clouds
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    public function getAll()
    {
        return $this->all;
    }

    public function setAll($all)
    {
        $this->all = $all;
        return $this;
    }
}
