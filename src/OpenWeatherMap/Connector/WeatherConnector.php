<?php
/**
 * WeatherConnector.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
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
namespace OpenWeatherMap\Connector;

use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Hydrator\Strategy\CurrentStrategy;

/**
 * WeatherConnector
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherConnector extends AbstractConnector implements WeatherConnectorInterface
{
    /**
     *
     * @var string
     */
    protected $endPoint = 'weather';
    
    public function getStrategy()
    {
        return new CurrentStrategy();
    }
    
    /**
     * 
     * @param array $options
     * 
     * @return Current
     */
    public function getWeather($options = array())
    {
        return parent::query($options);
    }
}
