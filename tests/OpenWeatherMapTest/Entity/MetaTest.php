<?php
/**
 * MetaTest.php
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

use OpenWeatherMap\Entity\Meta;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * MetaTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class MetaTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the calc time
     *
     * @covers \OpenWeatherMap\Entity\Meta::getCalctime
     * @covers \OpenWeatherMap\Entity\Meta::setCalctime
     */
    public function testGetSetCalcTime()
    {
        $calcTime = 0.0154;
        $meta = new Meta();

        $this->assertNull($meta->getCalcTime());
        $this->assertSame($meta, $meta->setCalcTime($calcTime));
        $this->assertEquals($calcTime, $meta->getCalcTime());
    }

    /**
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Meta::setCalctime
     */
    public function testSetCalcTimeThrowsException()
    {
        $meta = new Meta();

        $meta->setCalcTime(new stdClass());
    }
}
