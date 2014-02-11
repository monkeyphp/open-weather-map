<?php
/**
 * ConnectorFactoryTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector\Factory
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
namespace OpenWeatherMapTest\Connector\Factory;

use OpenWeatherMap\Connector\Factory\ConnectorFactory;
use PHPUnit_Framework_TestCase;

/**
 * ConnectorFactoryTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector\Factory
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ConnectorFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can construct an instance of ConnectorFactory
     *
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::__construct
     */
    public function test__construct()
    {
        $connectorFactory = new ConnectorFactory();
        $this->assertInstanceOf('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface', $connectorFactory);
    }

    /**
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::setOptions
     */
    public function testSetOptions()
    {
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        $connectorFactory = new ConnectorFactory();
        $options = array(
            'lock' => $mockLock
        );
        $connectorFactory->setOptions($options);

        $this->assertSame($mockLock, $connectorFactory->getLock());
    }

    /**
     * Test that calling getLock will return an instance of LockInterface
     *
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::getLock
     */
    public function testGetLock()
    {
        $connectorFactory = new ConnectorFactory();
        $this->assertInstanceOf('\OpenWeatherMap\Lock\LockInterface', $connectorFactory->getLock());
    }

    /**
     * Test that we can set the Lock instance
     *
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::setLock
     */
    public function testSetLock()
    {
        $connectorFactory = new ConnectorFactory();
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');

        $this->assertSame($connectorFactory, $connectorFactory->setLock($mockLock));
        $this->assertSame($connectorFactory->getLock(), $mockLock);
    }

    /**
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::setLock
     */
    public function testSetLockWithArray()
    {
        $minLifetime = 100;
        $options = array('minLifetime' => $minLifetime);
        $connectorFactory = new ConnectorFactory();
        $connectorFactory->setLock($options);

        $this->assertEquals(
            $minLifetime,
            $connectorFactory->getLock()->getMinLifetime()
        );
    }

    /**
     * Test that we can get an instance of WeatherConnector and that the Lock instance
     * is injected into it
     *
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::getWeatherConnector
     */
    public function testGetWeatherConnector()
    {
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        $connectorFactory = new ConnectorFactory();
        $connectorFactory->setLock($mockLock);

        $weatherConnector = $connectorFactory->getWeatherConnector();

        $this->assertInstanceof('\OpenWeatherMap\Connector\WeatherConnectorInterface', $weatherConnector);
        $this->assertSame($weatherConnector->getLock(), $mockLock);
    }

    /**
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::getDailyConnector
     */
    public function testGetDailyConnector()
    {
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        $connectorFactory = new ConnectorFactory();
        $connectorFactory->setLock($mockLock);

        $dailyConnector = $connectorFactory->getDailyConnector();

        $this->assertInstanceOf('\OpenWeatherMap\Connector\DailyConnectorInterface', $dailyConnector);
        $this->assertSame($dailyConnector->getLock(), $mockLock);
    }

    /**
     * @covers \OpenWeatherMap\Connector\Factory\ConnectorFactory::getForecastConnector
     */
    public function testGetForecastConnector()
    {
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        $connectorFactory = new ConnectorFactory();
        $connectorFactory->setLock($mockLock);

        $forecastConnector = $connectorFactory->getForecastConnector();

        $this->assertInstanceOf('\OpenWeatherMap\Connector\ForecastConnectorInterface', $forecastConnector);
        $this->assertSame($forecastConnector->getLock(), $mockLock);
    }
}
