<?php
/**
 * Sun.php
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

use DateTime;
use Exception;
use InvalidArgumentException;

/**
 * Sun
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Sun
{
    /**
     *
     * @var DateTime
     */
    protected $rise;

    /**
     *
     * @var DateTime
     */
    protected $set;

    /**
     * Return the date time of the sun rise
     *
     * @return DateTime|null
     */
    public function getRise()
    {
        return $this->rise;
    }

    /**
     * Return the datetime of the sun set
     *
     * @return DateTime|null
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * Set the rise value
     *
     * @example 2014-02-09T11:56:27
     *
     * @param string|null|DateTime $rise
     *
     * @return Sun
     * @throws InvalidArgumentException
     */
    public function setRise($rise = null)
    {
        if (! is_null($rise)) {
            if (! $rise instanceof DateTime) {
                try {
                    $rise = DateTime::createFromFormat('Y-m-d\TH:i:s', $rise);
                } catch (Exception $exception) {
                    throw new InvalidArgumentException('Expects a string (' . $rise . ') supplied');
                }
            }
        }
        $this->rise = $rise;
        return $this;
    }

    /**
     * Set the set value
     *
     * @param null|string\DateTime $set
     *
     * @return Sun
     * @throws InvalidArgumentException
     */
    public function setSet($set = null)
    {
        if (! is_null($set)) {
            if (! $set instanceof DateTime) {
                try {
                    $set = DateTime::createFromFormat('Y-m-d\TH:i:s', $set);
                } catch (Exception $exception) {
                    throw new InvalidArgumentException('Expects a string');
                }
            }
        }
        $this->set = $set;
        return $this;
    }
}
