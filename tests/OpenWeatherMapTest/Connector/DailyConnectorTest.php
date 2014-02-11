<?php
/**
 * DailyConnectorTest.php
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

use OpenWeatherMap\Connector\DailyConnector;
use PHPUnit_Framework_TestCase;

/**
 * DailyConnectorTest
 *
 * Test cases for instance of DailyConnector
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class DailyConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get the strategy class
     */
    public function testGetStrategy()
    {
        $dailyConnector = new DailyConnector();
        $strategy = $dailyConnector->getStrategy();

        $this->assertInstanceOf('\OpenWeatherMap\Hydrator\Strategy\WeatherDataStrategy', $strategy);
    }

    /**
     * Test that we can get the input filter
     */
    public function testGetInputFilter()
    {
        $dailyConnector = new DailyConnector();
        $inputFilter = $dailyConnector->getInputFilter();

        $this->assertInstanceOf('\Zend\InputFilter\InputFilter', $inputFilter);
    }

    /**
     * Test that we can set and get the default count
     */
    public function testGetSetDefaultCount()
    {
        $defaultCount = 5;
        $dailyConnector = new DailyConnector();

        $this->assertEquals(7, $dailyConnector->getDefaultCount());
        $this->assertSame($dailyConnector, $dailyConnector->setDefaultCount($defaultCount));
        $this->assertEquals($defaultCount, $dailyConnector->getDefaultCount());
    }

    /**
     * Test the we can get the default options
     */
    public function testGetDefaultOptions()
    {
        $dailyConnector = new DailyConnector();
        $defaultOptions = $dailyConnector->getDefaultOptions();

        $this->assertArrayHasKey('count', $defaultOptions);
    }

    /**
     * Test that we can parse the params
     */
    public function testParseParams()
    {
        $count = 5;
        $dailyConnector = new DailyConnector();
        $options = array('count' => $count);
        $params = $dailyConnector->parseParams($options);

        $this->assertArrayHasKey(DailyConnector::PARAM_COUNT, $params);
    }

    /**
     * Test that we can get the daily forecast using the xml mode and supplying
     * a query string
     */
    public function testGetDailyXmlUsingQuery()
    {
        $dailyConnector = new DailyConnector();
        $options = array(
            'query' => 'Harrogate,UK',
        );
        $results = file_get_contents(__DIR__ . '/../../data/daily/xml/york.xml');

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
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface', array(), array(), 'mockLock', false);
        $mockLock->expects($this->once())
            ->method('acquire')
            ->will($this->returnValue(true));
        $mockLock->expects($this->once())
            ->method('release')
            ->will($this->returnValue(true));
        $dailyConnector->setHttpClient($mockClient);
        $dailyConnector->setLock($mockLock);

        $weatherData = $dailyConnector->getDaily($options);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WeatherData', $weatherData);
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Location', $weatherData->getLocation());
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Forecast', $weatherData->getForecast());
    }

    /**
     * Test that we can get the daily forecast using the json mode and supplying
     * a query string
     */
    public function testGetDailyJsonUsingQuery()
    {
        $dailyConnector = new DailyConnector();
        $options = array(
            'query' => 'Harrogate,UK',
            'mode' => 'json'
        );
        $results = file_get_contents(__DIR__ . '/../../data/daily/json/york.json');

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
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface', array(), array(), 'mockLock', false);
        $mockLock->expects($this->once())
            ->method('acquire')
            ->will($this->returnValue(true));
        $mockLock->expects($this->once())
            ->method('release')
            ->will($this->returnValue(true));
        $dailyConnector->setHttpClient($mockClient);
        $dailyConnector->setLock($mockLock);

        $weatherData = $dailyConnector->getDaily($options);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WeatherData', $weatherData);
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Location', $weatherData->getLocation());
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Forecast', $weatherData->getForecast());
    }

    /**
     * Test that we can get the daily forecast using the xml mode
     * and supplying a latitude and longitude
     */
    public function testGetDailyXmlUsingLatitudeLongitude()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test that we can get the daily forecast using the json mode
     * and supplying a latitude and longitude
     *
     * @group egg
     */
    public function testGetDailyJsonUsingLatitudeLongitude()
    {
        $dailyConnector = new DailyConnector();
        $options = array(
            'latitude'  => 35,
            'longitude' => 139,
            'mode'      => 'json'
        );
        $results = file_get_contents(__DIR__ . '/../../data/daily/json/lat_35_lng_139.json');

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
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface', array(), array(), 'mockLock', false);
        $mockLock->expects($this->once())
            ->method('acquire')
            ->will($this->returnValue(true));
        $mockLock->expects($this->once())
            ->method('release')
            ->will($this->returnValue(true));
        $dailyConnector->setHttpClient($mockClient);
        $dailyConnector->setLock($mockLock);

        $weatherData = $dailyConnector->getDaily($options);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WeatherData', $weatherData);

        $location = $weatherData->getLocation();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Location', $location);
        $this->assertEquals(1851632, $location->getId());
    }

    /**
     * Test that we can get the daily forecast using the xml mode
     * and supplying an id
     */
    public function testGetDailyXmlUsingId()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test that we can get the daily forecast using the json mode and
     * supplying an id
     */
    public function testDailyJsonUsingId()
    {
        $dailyConnector = new DailyConnector();
        $options = array(
            'id'   => 524901,
            'mode' => 'json'
        );
        $results = file_get_contents(__DIR__ . '/../../data/daily/json/524901.json');

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
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface', array(), array(), 'mockLock', false);
        $mockLock->expects($this->once())
            ->method('acquire')
            ->will($this->returnValue(true));
        $mockLock->expects($this->once())
            ->method('release')
            ->will($this->returnValue(true));
        $dailyConnector->setHttpClient($mockClient);
        $dailyConnector->setLock($mockLock);

        $weatherData = $dailyConnector->getDaily($options);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WeatherData', $weatherData);


        $location = $weatherData->getLocation();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Location', $location);
        $this->assertEquals(524901, $location->getId());
        $this->assertEquals(1000000, $location->getPopulation());
    }
}
