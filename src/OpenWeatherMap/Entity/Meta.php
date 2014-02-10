<?php
/**
 * Meta.php
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
 * Meta
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Meta
{
    /**
     * The last update
     *
     * @var string|null
     */
    protected $lastUpdate;

    /**
     * The calc time
     *
     * @var float|null
     */
    protected $calcTime;

    /**
     * The next update
     *
     * @var string|null
     */
    protected $nextUpdate;

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function getCalcTime()
    {
        return $this->calcTime;
    }

    public function getNextUpdate()
    {
        return $this->nextUpdate;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * Set the calc time value
     *
     * @param string|int|float|null $calcTime
     *
     * @return Meta
     */
    public function setCalcTime($calcTime = null)
    {
        if (! is_null($calcTime)) {
            if (! is_scalar($calcTime) || ! is_numeric($calcTime)) {
                throw new \InvalidArgumentException('Expects a numeric');
            }
            $this->calcTime = (float)$calcTime;
        }
        $this->calcTime = $calcTime;
        return $this;
    }

    public function setNextUpdate($nextUpdate)
    {
        $this->nextUpdate = $nextUpdate;
        return $this;
    }
}
