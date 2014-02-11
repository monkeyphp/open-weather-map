<?php
/**
 * Current.php
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
 * Current
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Current
{
    /**
     * Instance of City
     *
     * @var City|null
     */
    protected $city;

    /**
     * Instance of Temperature
     *
     * @var Temperature|null
     */
    protected $temperature;

    /**
     * Instance of Humidity
     *
     * @var Humidity|null
     */
    protected $humidity;

    /**
     * Instance of Pressure
     *
     * @var Pressure|null
     */
    protected $pressure;

    /**
     * Instance of WindSpeed
     *
     * @var WindSpeed|null
     */
    protected $windSpeed;

    /**
     * Instance of WindDirection
     *
     * @var WindDirection|null
     */
    protected $windDirection;

    /**
     * Instance of Clouds
     *
     * @var Clouds|null
     */
    protected $clouds;

    /**
     * Instance of Precipitation
     *
     * @var Precipitation|null
     */
    protected $precipitation;

    /**
     * Instance of Weather
     *
     * @var Weather|null
     */
    protected $weather;

    /**
     * The last update
     *
     * @example 2014-01-18T10:11:11
     * 
     * @var string
     */
    protected $lastUpdate;

    /**
     * Return the Humidity
     *
     * @return Humidity|null
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Set the Humidity instance
     *
     * @param Humidity|null $humidity The Humidity instance
     *
     * @return Current
     */
    public function setHumidity(Humidity $humidity = null)
    {
        $this->humidity = $humidity;
        return $this;
    }

    /**
     * Return the City instance
     *
     * @return City|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Return the Temperature instance
     *
     * @return Temperature|null
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Return the Pressure instance
     *
     * @return Pressure|null
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Return the instance of Clouds
     *
     * @return Clouds|null
     */
    public function getClouds()
    {
        return $this->clouds;
    }

    /**
     * Return the Precipitation instance
     *
     * @return Precipitation|null
     */
    public function getPrecipitation()
    {
        return $this->precipitation;
    }

    /**
     * Return the Weather instance
     *
     * @return Weather|null
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * Return the last update value
     *
     * @return string|mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set the City instance
     *
     * @param City|null $city The City instance
     *
     * @return Current
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Set the Temperature instance
     *
     * @param Temperature|null $temperature The Temperature instance
     *
     * @return Current
     */
    public function setTemperature(Temperature $temperature = null)
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * Set the Pressure instance
     *
     * @param Pressure|null $pressure The Pressure instance
     *
     * @return Current
     */
    public function setPressure(Pressure $pressure = null)
    {
        $this->pressure = $pressure;
        return $this;
    }

    /**
     * Set the Clouds instance
     *
     * @param Clouds|null $clouds The Clouds instance
     *
     * @return Current
     */
    public function setClouds(Clouds $clouds = null)
    {
        $this->clouds = $clouds;
        return $this;
    }

    /**
     * Set the Precipitation instance
     *
     * @param Precipitation $precipitation
     *
     * @return Current
     */
    public function setPrecipitation(Precipitation $precipitation)
    {
        $this->precipitation = $precipitation;
        return $this;
    }

    /**
     * Set the Weather instance
     *
     * @param Weather $weather
     *
     * @return Current
     */
    public function setWeather(Weather $weather)
    {
        $this->weather = $weather;
        return $this;
    }

    /**
     * Set the lastUpdate value
     *
     * @param string|null $lastUpdate
     *
     * @return Current
     */
    public function setLastUpdate($lastUpdate = null)
    {
        if (! is_null($lastUpdate)) {
            if (! is_string($lastUpdate)) {
                throw new InvalidArgumentException('Expects a string');
            }
        }
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * Return the WindSpeed instance
     *
     * @return WindSpeed|null
     */
    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    /**
     * Return the WindDirection instance
     *
     * @return WindDirection|null
     */
    public function getWindDirection()
    {
        return $this->windDirection;
    }

    /**
     * Set the WindSpeed instance
     *
     * @param WindSpeed $windSpeed The WindSpeed instance
     *
     * @return Current
     */
    public function setWindSpeed(WindSpeed $windSpeed = null)
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    /**
     * Set the WindDirection instance
     *
     * @param WindDirection|null $windDirection The WindDirection instance
     *
     * @return Current
     */
    public function setWindDirection(WindDirection $windDirection = null)
    {
        $this->windDirection = $windDirection;
        return $this;
    }
}
