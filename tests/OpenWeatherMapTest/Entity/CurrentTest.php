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
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Entity\Humidity;
use OpenWeatherMap\Entity\Temperature;
use PHPUnit_Framework_TestCase;

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
        $pressure = new \OpenWeatherMap\Entity\Pressure();

        $this->assertNull($current->getPressure());
        $this->assertSame($current, $current->setPressure($pressure));
        $this->assertSame($pressure, $current->getPressure());
    }

    public function testGetSetWindSpeed()
    {
        $current = new Current();
    }

    public function testGetSetWindDirection()
    {
        $current = new Current();
    }

    public function testGetSetClouds()
    {
        $current = new Current();
    }

    public function testGetSetPrecipitation()
    {
        $current = new Current();
    }

    public function testGetSetWeather()
    {
        $current = new Current();
    }

    public function testGetSetLastUpdate()
    {
        $current = new Current();
    }
}
