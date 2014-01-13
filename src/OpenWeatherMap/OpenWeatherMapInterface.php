<?php
/**
 * OpenWeatherMapInterface.php
 * 
 * @category OpenWeatherMap
 * @package  OpenWeatherMap
 * @author   David White [monkeyphp] <david@monkeyphp.com>
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
namespace OpenWeatherMap;

use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Entity\WeatherData;

/**
 * OpenWeatherMapInterface
 * 
 * @category OpenWeatherMap
 * @package  OpenWeatherMap
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
interface OpenWeatherMapInterface
{
    /**
     * Return an instance of Current
     * 
     * @param array $options
     * 
     * @return Current
     */
    public function getWeather($options = array());
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getDaily($options = array());
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getForecast($options = array());
}
