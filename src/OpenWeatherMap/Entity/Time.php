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
    protected $symbol;
    
    protected $precipitation;
    
    protected $windDirection;
    
    protected $windSpeed;
    
    protected $temperature;
    
    protected $pressure;
    
    protected $humidity;
    
    protected $clouds;
    
    protected $day;
    
    protected $from;
    
    protected $to;
    
    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getPrecipitation()
    {
        return $this->precipitation;
    }

    public function getWindDirection()
    {
        return $this->windDirection;
    }

    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getPressure()
    {
        return $this->pressure;
    }

    public function getHumidity()
    {
        return $this->humidity;
    }

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
