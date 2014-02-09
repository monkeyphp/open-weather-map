<?php
/**
 * CurrentTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
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
namespace OpenWeatherMapTest\Entity;

use OpenWeatherMap\Entity\City;
use OpenWeatherMap\Entity\Clouds;
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Entity\Humidity;
use OpenWeatherMap\Entity\Precipitation;
use OpenWeatherMap\Entity\Pressure;
use OpenWeatherMap\Entity\Temperature;
use OpenWeatherMap\Entity\Weather;
use OpenWeatherMap\Entity\WindDirection;
use OpenWeatherMap\Entity\WindSpeed;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * CurrentTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CurrentTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the City instance
     *
     * @covers \OpenWeatherMap\Entity\Current::getCity
     * @covers \OpenWeatherMap\Entity\Current::setCity
     */
    public function testGetSetCity()
    {
        $current = new Current();
        $city = new City();

        $this->assertNull($current->getCity());
        $this->assertSame($current, $current->setCity($city));
        $this->assertSame($city, $current->getCity());
    }

    /**
     * Test that we can get and set the Temperature instance
     *
     * @covers \OpenWeatherMap\Entity\Current::getTemperature
     * @covers \OpenWeatherMap\Entity\Current::setTemperature
     */
    public function testGetSetTemperature()
    {
        $current = new Current();
        $temperature = new Temperature();

        $this->assertNull($current->getTemperature());
        $this->assertSame($current, $current->setTemperature($temperature));
        $this->assertSame($temperature, $current->getTemperature());
    }

    /**
     * Test that we can get and set the humidity
     *
     * @covers \OpenWeatherMap\Entity\Current::getHumidity
     * @covers \OpenWeatherMap\Entity\Current::setHumidity
     */
    public function testGetSetHumidity()
    {
        $current = new Current();
        $humidity = new Humidity();

        $this->assertNull($current->getHumidity());
        $this->assertSame($current, $current->setHumidity($humidity));
        $this->assertSame($humidity, $current->getHumidity());
    }

    /**
     * Test that we get and set the pressure property
     *
     * @covers \OpenWeatherMap\Entity\Current::getPressure
     * @covers \OpenWeatherMap\Entity\Current::setPressure
     */
    public function testGetSetPressure()
    {
        $current = new Current();
        $pressure = new Pressure();

        $this->assertNull($current->getPressure());
        $this->assertSame($current, $current->setPressure($pressure));
        $this->assertSame($pressure, $current->getPressure());
    }

    /**
     * Test that we can get and set the WindSpeed
     *
     * @covers \OpenWeatherMap\Entity\Current::getWindSpeed
     * @covers \OpenWeatherMap\Entity\Current::setWindSpeed
     */
    public function testGetSetWindSpeed()
    {
        $current = new Current();
        $windSpeed = new WindSpeed();

        $this->assertNull($current->getWindSpeed());
        $this->assertSame($current, $current->setWindSpeed($windSpeed));
        $this->assertSame($windSpeed, $current->getWindSpeed());
    }

    /**
     * Test that we can get and set the WindDirection
     *
     * @covers \OpenWeatherMap\Entity\Current::getWindDirection
     * @covers \OpenWeatherMap\Entity\Current::setWindDirection
     */
    public function testGetSetWindDirection()
    {
        $current = new Current();
        $windDirection = new WindDirection();

        $this->assertNull($current->getWindDirection());
        $this->assertSame($current, $current->setWindDirection($windDirection));
        $this->assertSame($windDirection, $current->getWindDirection());
    }

    /**
     * Test that we can get and set the Clouds
     *
     * @covers \OpenWeatherMap\Entity\Current::getClouds
     * @covers \OpenWeatherMap\Entity\Current::setClouds
     */
    public function testGetSetClouds()
    {
        $current = new Current();
        $clouds = new Clouds();

        $this->assertNull($current->getClouds());
        $this->assertSame($current, $current->setClouds($clouds));
        $this->assertSame($clouds, $current->getClouds());
    }

    /**
     * Test that we can get and set the Precipitation
     *
     * @covers \OpenWeatherMap\Entity\Current::getPrecipitation
     * @covers \OpenWeatherMap\Entity\Current::setPrecipitation
     */
    public function testGetSetPrecipitation()
    {
        $current = new Current();
        $precipitation = new Precipitation();

        $this->assertNull($current->getPrecipitation());
        $this->assertSame($current, $current->setPrecipitation($precipitation));
        $this->assertSame($precipitation, $current->getPrecipitation());
    }

    /**
     * Test that we can get and set the Weather
     *
     * @covers \OpenWeatherMap\Entity\Current::getWeather
     * @covers \OpenWeatherMap\Entity\Current::setWeather
     */
    public function testGetSetWeather()
    {
        $current = new Current();
        $weather = new Weather();

        $this->assertNull($current->getWeather());
        $this->assertSame($current, $current->setWeather($weather));
        $this->assertSame($weather, $current->getWeather());
    }

    /**
     * Test that we can get and set the last update
     *
     * @covers \OpenWeatherMap\Entity\Current::getLastUpdate
     * @covers \OpenWeatherMap\Entity\Current::setLastUpdate
     */
    public function testGetSetLastUpdate()
    {
        $current = new Current();
        $lastUpdate = "2014-01-18T10:11:11";

        $this->assertNull($current->getLastUpdate());
        $this->assertSame($current, $current->setLastUpdate($lastUpdate));
        $this->assertEquals($lastUpdate, $current->getLastUpdate());
    }

    /**
     * Test that attempting to set the lastupdate value using a non string
     * value results in an exception
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Current::setLastUpdate
     */
    public function testSetLastUpdateThrowsException()
    {
        $current = new Current();

        $current->setLastUpdate(new stdClass());
    }
}
