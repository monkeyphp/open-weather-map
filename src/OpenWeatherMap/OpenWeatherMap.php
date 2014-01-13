<?php
/**
 * OpenWeatherMap.php
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

use OpenWeatherMap\Connector\DailyConnectorInterface;
use OpenWeatherMap\Connector\Factory\ConnectorFactory;
use OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface;
use OpenWeatherMap\Connector\ForecastConnectorInterface;
use OpenWeatherMap\Connector\WeatherConnectorInterface;
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Entity\WeatherData;

/**
 * OpenWeatherMap
 * 
 * @category OpenWeatherMap
 * @package  OpenWeatherMap
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class OpenWeatherMap implements OpenWeatherMapInterface
{
    /**
     * Instance of ConnectorFactoryInterface
     * 
     * @var ConnectorFactoryInterface
     */
    protected $connectorFactory;
    
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
     * Instance of ForecastConnectorInterface
     * 
     * @var ForecastConnectorInterface
     */
    protected $forecastConnector;
    
    /**
     * Set the ConnectorFactory instance
     * 
     * @param ConnectorFactoryInterface $connectorFactory
     * 
     * @return OpenWeatherMap
     */
    public function setConnectorFactory(ConnectorFactoryInterface $connectorFactory)
    {
        $this->connectorFactory = $connectorFactory;
        return $this;
    }
    
    /**
     * Return the ConnectorFactory instance
     * 
     * @return ConnectorFactoryInterface
     */
    public function getConnectorFactory()
    {
        if (! isset($this->connectorFactory)) {
            $this->connectorFactory = new ConnectorFactory();
        }
        return $this->connectorFactory;
    }
    
    /**
     * Return the instance of WeatherConnectorInterface
     * 
     * @return WeatherConnectorInterface
     */
    public function getWeatherConnector()
    {
        if (! isset($this->weatherConnector)) {
            $this->weatherConnector = $this->getConnectorFactory()->getWeatherConnector();
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
            $this->dailyConnector = $this->getConnectorFactory()->getDailyConnector();
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
        if (! isset($this->forecastConnector)) {
            $this->forecastConnector = $this->getConnectorFactory()->getForecastConnector();
        }
        return $this->forecastConnector;
    }
    
    /**
     * Return an instance of \OpenWeatherMap\Entity\Current
     * 
     * @param array $options
     * 
     * @return Current
     */
    public function getWeather($options = array())
    {
        return $this->getWeatherConnector()->getWeather($options);
    }
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getDaily($options = array())
    {
        return $this->getDailyConnector()->getDaily($options);
    }
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getForecast($options = array())
    {
        return $this->getForecastConnector()->getForecast($options);
    }
}
