<?php
/**
 * ForecastConnectorTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
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
namespace OpenWeatherMapTest\Connector;

use OpenWeatherMap\Connector\ForecastConnector;
use PHPUnit_Framework_TestCase;

/**
 * ForecastConnectorTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ForecastConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can retrieve the weather forecast using a query
     */
    public function testGetForecastByQuery()
    {
        $forecastConnector = new ForecastConnector();
        $options = array(
            'query' => 'London,UK',
          //  'mode' => 'json'
        );

        $results = file_get_contents(__DIR__ . '/../../data/forecast/xml/london.xml');
        //$results = file_get_contents(__DIR__ . '/../../data/forecast/json/london.json');

        $mockResponse = $this->getMock('\Zend\Http\Response');
        $mockResponse->expects($this->once())
            ->method('isSuccess')
            ->will($this->returnValue(true));
        $mockResponse->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($results));
        $mockClient = $this->getMock('\Zend\Http\Client');
        $mockClient->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf('\Zend\Http\Request'))
            ->will($this->returnValue($mockResponse));
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\Lock', array(), array(), 'mockLock', false);
        $mockLock->expects($this->once())
            ->method('lock')
            ->will($this->returnValue(true));
        $mockLock->expects($this->once())
            ->method('unlock')
            ->will($this->returnValue(true));
        $forecastConnector->setHttpClient($mockClient);
        $forecastConnector->setLock($mockLock);

        $weatherData = $forecastConnector->getForecast($options);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WeatherData', $weatherData);
    }
}
