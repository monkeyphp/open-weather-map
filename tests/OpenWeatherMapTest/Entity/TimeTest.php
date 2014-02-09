<?php
/**
 * TimeTest.php
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

use OpenWeatherMap\Entity\Clouds;
use OpenWeatherMap\Entity\Humidity;
use OpenWeatherMap\Entity\Precipitation;
use OpenWeatherMap\Entity\Pressure;
use OpenWeatherMap\Entity\Symbol;
use OpenWeatherMap\Entity\Temperature;
use OpenWeatherMap\Entity\Time;
use OpenWeatherMap\Entity\WindDirection;
use OpenWeatherMap\Entity\WindSpeed;
use PHPUnit_Framework_TestCase;

/**
 * TimeTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Entity\Time::getSymbol
     * @covers \OpenWeatherMap\Entity\Time::setSymbol
     */
    public function testGetSetSymbol()
    {
        $symbol = new Symbol();
        $time = new Time();

        $this->assertNull($time->getSymbol());
        $this->assertSame($time, $time->setSymbol($symbol));
        $this->assertSame($symbol, $time->getSymbol());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getPrecipitation
     * @covers \OpenWeatherMap\Entity\Time::setPrecipitation
     */
    public function testGetSetPrecipitation()
    {
        $precipitation = new Precipitation();
        $time = new Time();

        $this->assertNull($time->getPrecipitation());
        $this->assertSame($time, $time->setPrecipitation($precipitation));
        $this->assertSame($precipitation, $time->getPrecipitation());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getWindDirection
     * @covers \OpenWeatherMap\Entity\Time::setWindDirection
     */
    public function testGetSetWindDirection()
    {
        $windDirection = new WindDirection();
        $time = new Time();

        $this->assertNull($time->getWindDirection());
        $this->assertSame($time, $time->setWindDirection($windDirection));
        $this->assertSame($windDirection, $time->getWindDirection());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getWindSpeed
     * @covers \OpenWeatherMap\Entity\Time::setWindSpeed
     */
    public function testGetSetWindSpeed()
    {
        $windSpeed = new WindSpeed();
        $time = new Time();

        $this->assertNull($time->getWindSpeed());
        $this->assertSame($time, $time->setWindSpeed($windSpeed));
        $this->assertSame($windSpeed, $time->getWindSpeed());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getTemperature
     * @covers \OpenWeatherMap\Entity\Time::setTemperature
     */
    public function testGetSetTemperature()
    {
        $temperature = new Temperature();
        $time = new Time();

        $this->assertNull($time->getTemperature());
        $this->assertSame($time, $time->setTemperature($temperature));
        $this->assertSame($temperature, $time->getTemperature());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getPressure
     * @covers \OpenWeatherMap\Entity\Time::setPressure
     */
    public function testGetSetPressure()
    {
        $pressure = new Pressure();
        $time = new Time();

        $this->assertNull($time->getPressure());
        $this->assertSame($time, $time->setPressure($pressure));
        $this->assertSame($pressure, $time->getPressure());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getHumidity
     * @covers \OpenWeatherMap\Entity\Time::setHumidity
     */
    public function testGetSetHumidity()
    {
        $humidity = new Humidity();
        $time = new Time();

        $this->assertNull($time->getHumidity());
        $this->assertSame($time, $time->setHumidity($humidity));
        $this->assertSame($humidity, $time->getHumidity());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Time::getClouds
     * @covers \OpenWeatherMap\Entity\Time::setClouds
     */
    public function testGetSetClouds()
    {
        $clouds = new Clouds();
        $time = new Time();

        $this->assertNull($time->getClouds());
        $this->assertSame($time, $time->setClouds($clouds));
        $this->assertSame($clouds, $time->getClouds());
    }

    public function testGetSetDay()
    {

    }

    public function testGetSetFrom()
    {

    }

    public function testGetSetTo()
    {

    }
}
