<?php
/**
 * SunTest.php
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

use DateTime;
use OpenWeatherMap\Entity\Sun;
use PHPUnit_Framework_TestCase;

/**
 * SunTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class SunTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Entity\Sun::getRise
     * @covers \OpenWeatherMap\Entity\Sun::setRise
     */
    public function testGetSetRise()
    {
        $rise = '2014-01-27T08:00:14';
        $sun = new Sun();

        $this->assertNull($sun->getRise());
        $this->assertSame($sun, $sun->setRise($rise));
        $this->assertInstanceOf('DateTime', $sun->getRise());
    }

    /**
     * @covers \OpenWeatherMap\Entity\Sun::getSet
     * @covers \OpenWeatherMap\Entity\Sun::setSet
     */
    public function testGetSetSet()
    {
        $set = '2014-01-27T16:37:44';
        $sun = new Sun();

        $this->assertNull($sun->getSet());
        $this->assertSame($sun, $sun->setSet($set));
        $this->assertInstanceOf('DateTime', $sun->getSet());
    }
}
