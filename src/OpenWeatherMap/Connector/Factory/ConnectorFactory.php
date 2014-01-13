<?php
/**
 * ConnectorFactory.php
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

use OpenWeatherMap\Connector\DailyConnector;
use OpenWeatherMap\Connector\DailyConnectorInterface;
use OpenWeatherMap\Connector\ForecastConnector;
use OpenWeatherMap\Connector\ForecastConnectorInterface;
use OpenWeatherMap\Connector\WeatherConnector;
use OpenWeatherMap\Connector\WeatherConnectorInterface;

/**
 * ConnectorFactory
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector\Factory
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ConnectorFactory implements ConnectorFactoryInterface
{
    /**
     * Instance of WeatherConnectorInterface
     * 
     * @var WeatherConnectorInterface
     */
    protected $weatherConnector;
    
    /**
     * Instance of DailyConnectorInterface
     * 
     * @var DailyConnectorInterface
     */
    protected $dailyConnector;
    
    /**
     * Instance of ForecaseConnectorInterface
     * 
     * @var ForecastConnectorInterface
     */
    protected $forecaseConnector;
    
    /**
     * Return an instance of WeatherConnectorInterface
     * 
     * @return WeatherConnectorInterface
     */
    public function getWeatherConnector()
    {
        if (! isset($this->weatherConnector)) {
            $this->weatherConnector = new WeatherConnector;
        }
        return $this->weatherConnector;
    }
    
    /**
     * Return an instance of DailyConnectorInterface
     * 
     * @return DailyConnectorInterface
     */
    public function getDailyConnector()
    {
        if (! isset($this->dailyConnector)) {
            $this->dailyConnector = new DailyConnector();
        }
        return $this->dailyConnector;
    }
    
    /**
     * Return an instance of ForecastConnectorInterface
     * 
     * @return ForecastConnectorInterface
     */
    public function getForecastConnector()
    {
        if (! isset($this->forecaseConnectot)) {
            $this->forecastConnector = new ForecastConnector();
        }
        return $this->forecastConnector;
    }
}
