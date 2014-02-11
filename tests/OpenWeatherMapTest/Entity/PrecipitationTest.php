<?php
/**
 * PrecipitationTest.php
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

use InvalidArgumentException;
use OpenWeatherMap\Entity\Precipitation;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * PrecipitationTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class PrecipitationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can set and get the mode value
     *
     * @covers \OpenWeatherMap\Entity\Precipitation::getMode
     * @covers \OpenWeatherMap\Entity\Precipitation::setMode
     */
    public function testGetSetMode()
    {
        $precipitation = new Precipitation();
        $mode = 'no';

        $this->assertNull($precipitation->getMode());
        $this->assertSame($precipitation, $precipitation->setMode($mode));
        $this->assertEquals($mode, $precipitation->getMode());
    }

    /**
     * Test that passing an invalid value to setMode results in an exception
     * being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Precipitation::setMode
     */
    public function testSetModeThrowsException()
    {
        $precipitation = new Precipitation();
        $mode = new stdClass();

        $precipitation->setMode($mode);
    }

    /**
     * Test that we can set the value
     *
     * @covers \OpenWeatherMap\Entity\Precipitation::getValue
     * @covers \OpenWeatherMap\Entity\Precipitation::setValue
     */
    public function testGetSetValue()
    {
        $precipitation = new Precipitation();
        $value = 0.5;

        $this->assertNull($precipitation->getValue());
        $this->assertSame($precipitation, $precipitation->setValue($value));
        $this->assertEquals($value, $precipitation->getValue());
    }

    /**
     * Test that attempting to set the value with an object results in an exception
     * being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Precipitation::setValue
     */
    public function testSetValueWithObjectThrowsException()
    {
        $precipitation = new Precipitation();
        $value = new stdClass();

        $precipitation->setValue($value);
    }

    /**
     * Test that we can get and set the type
     *
     * @covers \OpenWeatherMap\Entity\Precipitation::getType
     * @covers \OpenWeatherMap\Entity\Precipitation::setType
     */
    public function testGetSetType()
    {
        $precipitation = new Precipitation();
        $type = "rain";

        $this->assertNull($precipitation->getType());
        $this->assertSame($precipitation, $precipitation->setType($type));
        $this->assertEquals($type, $precipitation->getType());
    }

    /**
     * Test that attempting to set the type with an invalid value
     * results in a exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Precipitation::setType
     */
    public function testSetTypeThrowsException()
    {
        $precipitation = new Precipitation();
        $type = new stdClass();

        $precipitation->setType($type);
    }
}
