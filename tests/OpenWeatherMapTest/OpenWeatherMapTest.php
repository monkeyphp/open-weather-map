<?php
/**
 * OpenWeatherMapTest.php
 *
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
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
namespace OpenWeatherMapTest;

use OpenWeatherMap\OpenWeatherMap;
use PHPUnit_Framework_TestCase;

/**
 * OpenWeatherMapTest
 *
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class OpenWeatherMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can create an instance of OpenWeatherMap
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::__construct
     */
    public function test__construct()
    {
        $openWeatherMap = new OpenWeatherMap();
        $this->assertInstanceOf('\OpenWeatherMap\OpenWeatherMapInterface', $openWeatherMap);
    }

    /**
     * Test that we can pass an options array when constructing an instance
     * of OpenWeatherMap
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::__construct
     */
    public function test__constructWithOptions()
    {
        $options = array(
            'defaults' => array(
                'language' => \OpenWeatherMap\Connector\AbstractConnector::LANGUAGE_DUTCH
            )
        );
        $openWeatherMap = new OpenWeatherMap($options);

        $this->assertEquals($options['defaults'], $openWeatherMap->getDefaults());
    }

    /**
     * Test that we can set the options value
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setOptions
     */
    public function testSetOptionsDefaults()
    {
        $query = 'Harrogate,UK';
        $options = array(
            'defaults' => array(
                'query' => $query
            )
        );
        $openWeatherMap = new OpenWeatherMap();

        $this->assertSame($openWeatherMap, $openWeatherMap->setOptions($options));
        $defaults = $openWeatherMap->getDefaults();
        $this->assertArrayHasKey('query', $defaults);
        $this->assertEquals($defaults['query'], $query);
    }

    /**
     * Test that we can set the options value
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setOptions
     */
    public function testSetOptionsConnectorFactory()
    {
        $connectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $options = array(
            'connectorFactory' => $connectorFactory
        );
        $openWeatherMap = new OpenWeatherMap();

        $this->assertSame($openWeatherMap, $openWeatherMap->setOptions($options));
        $this->assertSame($connectorFactory, $openWeatherMap->getConnectorFactory());
    }

    /**
     * Test that attampting to pass a non traversable parameter to setOptions
     * will be ignored
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setOptions
     */
    public function testSetOptionsIgnoresNonTraversable()
    {
        $openWeatherMap = new OpenWeatherMap();
        $options = new \stdClass();

        $this->assertNotInstanceOf('\Traversable', $options);

        $this->assertSame($openWeatherMap, $openWeatherMap->setOptions($options));
        $this->assertEmpty($openWeatherMap->getDefaults());
    }

    /**
     * Test that calling getDefaults will return an array if the options value
     * has not already been set
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::getDefaults
     */
    public function testGetDefaultsReturnsEmptyArray()
    {
        $openWeatherMap = new OpenWeatherMap();

        $defaults = $openWeatherMap->getDefaults();

        $this->assertInternalType('array', $defaults);
        $this->assertEmpty($defaults);
    }

    /**
     * Test that we can set valid default values
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setDefaults
     */
    public function testSetDefaultsWithValidValues()
    {
        $count = 5;
        $defaults = array('count' => $count);
        $openWeatherMap = new OpenWeatherMap();

        $this->assertEmpty($openWeatherMap->getDefaults());
        $this->assertSame($openWeatherMap, $openWeatherMap->setDefaults($defaults));

        $openWeatherMapDefaults = $openWeatherMap->getDefaults();
        $this->assertArrayHasKey('count', $openWeatherMapDefaults);
        $this->assertEquals($openWeatherMapDefaults['count'], $count);
    }

    /**
     * Test that invalid keys will be ignored
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setDefaults
     */
    public function testSetDefaultsIgnoresInvalidKeys()
    {
        $count = 5;
        $defaults = array('foobardeedum' => $count);
        $openWeatherMap = new OpenWeatherMap();

        $this->assertEmpty($openWeatherMap->getDefaults());
        $this->assertSame($openWeatherMap, $openWeatherMap->setDefaults($defaults));

        $openWeatherMapDefaults = $openWeatherMap->getDefaults();
        $this->assertEmpty($openWeatherMapDefaults);
        $this->assertArrayNotHasKey('foobardeedum', $openWeatherMapDefaults);
    }

    /**
     * Test that supplying 'query' in the array to mergeOptions will unset
     * the 'latitude' key in the default options passed to OpenWeatherMap
     * constructor
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::mergeOptions
     */
    public function testMergeOptionsWithQuery()
    {
        $defaults = array('latitude' => 10.0);
        $options = array('query' => 'London,UK');
        $openWeatherMap = new OpenWeatherMap(compact('defaults'));

        $this->assertSame($defaults, $openWeatherMap->getDefaults());
        $this->assertArrayNotHasKey('latitude', $openWeatherMap->mergeOptions($options));
    }

    /**
     * Test that calling getConnectorFactory will return an instance
     * of ConnectorFactoryInterface
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::getConnectorFactory
     */
    public function testGetConnectorFactory()
    {
        $openWeatherMap = new OpenWeatherMap();

        $this->assertInstanceOf('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface', $openWeatherMap->getConnectorFactory());
    }

    /**
     * Test that we can set the connector factory instance
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::setConnectorFactory
     */
    public function testSetConnectorFactory()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');

        $this->assertSame($openWeatherMap, $openWeatherMap->setConnectorFactory($mockConnectorFactory));
        $this->assertSame($mockConnectorFactory, $openWeatherMap->getConnectorFactory());
    }

    /**
     * Test that calling getWeatherConnector will return an instance of
     * WeatherConnectorInterface
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::getWeatherConnector
     */
    public function testGetWeatherConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockWeatherConnector = $this->getMock('\OpenWeatherMap\Connector\WeatherConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);

        $mockConnectorFactory->expects($this->once())
            ->method('getWeatherConnector')
            ->will($this->returnValue($mockWeatherConnector));

        $this->assertSame($mockWeatherConnector, $openWeatherMap->getWeatherConnector());
    }

    /**
     * Test that calling getDailyConnector will return an instance of
     * DailyConnectorInterface
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::getDailyConnector
     */
    public function testGetDailyConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockDailyConnector = $this->getMock('\OpenWeatherMap\Connector\DailyConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);

        $mockConnectorFactory->expects($this->once())
            ->method('getDailyConnector')
            ->will($this->returnValue($mockDailyConnector));

        $this->assertSame($mockDailyConnector, $openWeatherMap->getDailyConnector());
    }

    /**
     * Test that calling getForecaseConnector will return an instanc of
     * ForecastConnectorInterface
     *
     * @covers \OpenWeatherMap\OpenWeatherMap::getForecastConnector
     */
    public function testGetForecastConnector()
    {
        $openWeatherMap = new OpenWeatherMap();
        $mockConnectorFactory = $this->getMock('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface');
        $mockForecastConnector = $this->getMock('\OpenWeatherMap\Connector\ForecastConnectorInterface');
        $openWeatherMap->setConnectorFactory($mockConnectorFactory);

        $mockConnectorFactory->expects($this->once())
            ->method('getForecastConnector')
            ->will($this->returnValue($mockForecastConnector));

        $this->assertSame($mockForecastConnector, $openWeatherMap->getForecastConnector());
    }
}
