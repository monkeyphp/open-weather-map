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
     * @var City
     */
    protected $city;

    /**
     * Instance of Temperature
     *
     * @var Temperature
     */
    protected $temperature;

    /**
     * Instance of Humidity
     *
     * @var Humidity
     */
    protected $humidity;

    /**
     * Instance of Pressure
     *
     * @var Pressure
     */
    protected $pressure;

    /**
     *
     * @var WindSpeed
     */
    protected $windSpeed;

    /**
     *
     * @var WindDirection
     */
    protected $windDirection;

    /**
     *
     * @var Clouds
     */
    protected $clouds;

    /**
     *
     * @var Precipitation
     */
    protected $precipitation;

    /**
     *
     * @var Weather
     */
    protected $weather;

    /**
     *
     * @var string
     */
    protected $lastUpdate;


    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Set the Humidity instance
     *
     * @param Humidity $humidity
     *
     * @return Current
     */
    public function setHumidity(Humidity $humidity)
    {
        $this->humidity = $humidity;
        return $this;
    }


    public function getCity()
    {
        return $this->city;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }



    public function getPressure()
    {
        return $this->pressure;
    }


    public function getClouds()
    {
        return $this->clouds;
    }

    public function getPrecipitation()
    {
        return $this->precipitation;
    }

    public function getWeather()
    {
        return $this->weather;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set the City instance
     *
     * @param City $city
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
     * @param Temperature $temperature
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
     * @param Pressure $pressure
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
     * @param Clouds $clouds
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

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    public function getWindDirection()
    {
        return $this->windDirection;
    }

    public function setWindSpeed(WindSpeed $windSpeed)
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    public function setWindDirection(WindDirection $windDirection)
    {
        $this->windDirection = $windDirection;
        return $this;
    }
}
