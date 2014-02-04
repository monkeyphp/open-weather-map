<?php
/**
 * WeatherData.php
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
 * WeatherData
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherData
{
    /**
     * Instance of Location
     *
     * @var Location|null
     */
    protected $location;

    /**
     * Instance of Credit
     *
     * @var Credit|null
     */
    protected $credit;

    /**
     * Instance of Meta
     *
     * @var Meta|null
     */
    protected $meta;

    /**
     * Instance of Sun
     *
     * @var Sun|null
     */
    protected $sun;

    /**
     * Instance of Forecast
     *
     * @var Forecast|null
     */
    protected $forecast;

    /**
     * The number of returned records
     *
     * @var int|null
     */
    protected $count;

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    
    /**
     * Return the Location instance
     *
     * @return Location|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Return the Credit instance
     *
     * @return Credit|null
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Return the Meta instance
     *
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Return the Sun instance
     *
     * @return Sun|null
     */
    public function getSun()
    {
        return $this->sun;
    }

    /**
     * Return the Forecast instance
     *
     * @return Forecast|null
     */
    public function getForecast()
    {
        return $this->forecast;
    }

    /**
     * Set the Location instance
     *
     * @param Location|null $location
     *
     * @return WeatherData
     */
    public function setLocation(Location $location = null)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Set the Credit instance
     *
     * @param Credit $credit
     *
     * @return WeatherData
     */
    public function setCredit(Credit $credit = null)
    {
        $this->credit = $credit;
        return $this;
    }

    /**
     * Set the Meta instance
     *
     * @param Meta $meta
     *
     * @return WeatherData
     */
    public function setMeta(Meta $meta = null)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * Set the Sun instance
     *
     * @param Sun $sun
     *
     * @return WeatherData
     */
    public function setSun(Sun $sun)
    {
        $this->sun = $sun;
        return $this;
    }

    /**
     * Set the Forecast instance
     *
     * @param Forecast $forecast
     *
     * @return WeatherData
     */
    public function setForecast(Forecast $forecast)
    {
        $this->forecast = $forecast;
        return $this;
    }
}
