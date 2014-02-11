<?php
/**
 * Time.php
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
 * Time
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Time
{
    /**
     * Instance of Symbol
     * 
     * @var Symbol|null
     */
    protected $symbol;
    
    /**
     * Instance of Precipitation
     * 
     * @var Precipitation|null
     */
    protected $precipitation;
    
    /**
     * Instance of WindDirection
     * 
     * @var WindDirection|null
     */
    protected $windDirection;
    
    /**
     * Instance of WindSpeed
     * 
     * @var WindSpeed
     */
    protected $windSpeed;
    
    /**
     * Instance of Temperature
     * 
     * @var Temperature|null
     */
    protected $temperature;
    
    /**
     * Instance of Pressure
     * 
     * @var Pressure|null
     */
    protected $pressure;
    
    /**
     * Instance of Humidity
     * 
     * @var Humidity
     */
    protected $humidity;
    
    /**
     * Instance of Clouds
     * 
     * @var Clouds
     */
    protected $clouds;
    
    /**
     * eg 2014-01-26
     * 
     * @var string|null 
     */
    protected $day;
    
    /**
     * 2014-01-26T12:00:00
     * 
     * @var type 
     */
    protected $from;
    
    /**
     * 2014-01-26T15:00:00 
     * 
     * @var type
     */
    protected $to;
    
    /**
     * Return the Symbol
     * 
     * @return Symbol|null
     */
    public function getSymbol()
    {
        return $this->symbol;
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
     * Return the WindDirection instance
     * 
     * @return WindDirection|null
     */
    public function getWindDirection()
    {
        return $this->windDirection;
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
     * @return Pressure
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Return the Humidity instance
     * 
     * @return Humdity
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Return the Clouds instance
     * 
     * @return Clouds
     */
    public function getClouds()
    {
        return $this->clouds;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function setPrecipitation($precipitation)
    {
        $this->precipitation = $precipitation;
        return $this;
    }

    public function setWindDirection($windDirection)
    {
        $this->windDirection = $windDirection;
        return $this;
    }

    public function setWindSpeed($windSpeed)
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }

    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
        return $this;
    }

    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
        return $this;
    }

    public function setClouds($clouds)
    {
        $this->clouds = $clouds;
        return $this;
    }

    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }
}
