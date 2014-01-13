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
    protected $location;
    
    protected $credit;
    
    protected $meta;
    
    protected $sun;
    
    protected $forecast;
    
    public function getLocation()
    {
        return $this->location;
    }

    public function getCredit()
    {
        return $this->credit;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getSun()
    {
        return $this->sun;
    }

    public function getForecast()
    {
        return $this->forecast;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function setCredit($credit)
    {
        $this->credit = $credit;
        return $this;
    }

    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public function setSun($sun)
    {
        $this->sun = $sun;
        return $this;
    }

    public function setForecast($forecast)
    {
        $this->forecast = $forecast;
        return $this;
    }


}
