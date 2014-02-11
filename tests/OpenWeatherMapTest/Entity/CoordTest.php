<?php
/**
 * CoordTest.php
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

use OpenWeatherMap\Entity\Coord;
use PHPUnit_Framework_TestCase;

/**
 * CoordTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CoordTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the latitude
     *
     * @covers \OpenWeatherMap\Entity\Coord::getLatitude
     * @covers \OpenWeatherMap\Entity\Coord::setLatitude
     */
    public function testGetSetLatitude()
    {
        $coord = new Coord();
        $latitude = -16.92;

        $this->assertNull($coord->getLatitude());
        $this->assertSame($coord, $coord->setLatitude($latitude));
        $this->assertEquals($latitude, $coord->getLatitude());
    }

    /**
     * Test that we can get and set the longitude
     *
     * @covers \OpenWeatherMap\Entity\Coord::getLongitude
     * @covers \OpenWeatherMap\Entity\Coord::setLongitude
     */
    public function testGetSetLongitude()
    {
        $coord = new Coord();
        $longitude = 145.77;

        $this->assertNull($coord->getLongitude());
        $this->assertSame($coord, $coord->setLongitude($longitude));
        $this->assertEquals($longitude, $coord->getLongitude());
    }
}
