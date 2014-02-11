<?php
/**
 * WindDirectionTest.php
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

use OpenWeatherMap\Entity\WindDirection;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * WindDirectionTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindDirectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::getName
     * @covers \OpenWeatherMap\Entity\WindDirection::setName
     */
    public function testGetSetName()
    {
        $name = 'SouthEast';
        $windDirection = new WindDirection();

        $this->assertNull($windDirection->getName());
        $this->assertSame($windDirection, $windDirection->setName($name));
        $this->assertEquals($name, $windDirection->getName());
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::setName
     */
    public function testSetNameThrowsException()
    {
        $name = new stdClass();
        $windDirection = new WindDirection();

        $this->setExpectedException('\InvalidArgumentException');

        $windDirection->setName($name);
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::getValue
     * @covers \OpenWeatherMap\Entity\WindDirection::setValue
     */
    public function testGetSetValue()
    {
        $value = 126.501;
        $windDirection = new WindDirection();

        $this->assertNull($windDirection->getValue());
        $this->assertSame($windDirection, $windDirection->setValue($value));
        $this->assertEquals($value, $windDirection->getValue());
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::setValue
     */
    public function testSetValueThrowsException()
    {
        $value = new stdClass();
        $windDirection = new WindDirection();

        $this->setExpectedException('\InvalidArgumentException');

        $windDirection->setValue($value);
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::getCode
     * @covers \OpenWeatherMap\Entity\WindDirection::setCode
     */
    public function testGetSetCode()
    {
        $code = 'w';
        $windDirection = new WindDirection();

        $this->assertNull($windDirection->getCode());
        $this->assertSame($windDirection, $windDirection->setCode($code));
        $this->assertEquals($code, $windDirection->getCode());
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::setCode
     */
    public function testSetCodeThrowsException()
    {
        $code = new stdClass();
        $windDirection = new WindDirection();

        $this->setExpectedException('\InvalidArgumentException');

        $windDirection->setCode($code);
    }

    /**
     * @covers \OpenWeatherMap\Entity\WindDirection::getDeg
     * @covers \OpenWeatherMap\Entity\WindDirection::setDeg
     */
    public function testGetSetDeg()
    {
        $deg = "182.503";
        $windDirection = new WindDirection();

        $this->assertNull($windDirection->getDeg());
        $this->assertSame($windDirection, $windDirection->setDeg($deg));
        $this->assertEquals($deg, $windDirection->getDeg());
    }
}
