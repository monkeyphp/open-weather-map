<?php
/**
 * ConnectorFactoryInterface.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector\Factory
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
namespace OpenWeatherMap\Connector\Factory;

use OpenWeatherMap\Connector\WeatherConnectorInterface;

/**
 * ConnectorFactoryInterface
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector\Factory
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
interface ConnectorFactoryInterface
{
    /**
     * Return an instance of WeatherConnectorInterface
     * 
     * @return WeatherConnectorInterface
     */
    public function getWeatherConnector();
    
    /**
     * Return an instance DailyConnectorInterface
     * 
     * @return DailyConnectorInterface
     */
    public function getDailyConnector();
    
    /**
     * Return an instance of ForecastConnectorInteface
     * 
     * @return ForecastConnectorInterface
     */
    public function getForecastConnector();
}
