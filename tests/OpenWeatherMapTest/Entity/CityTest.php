<?php
/**
 * CityTest.php
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
use OpenWeatherMap\Entity\Coord;
use OpenWeatherMap\Entity\Sun;
use PHPUnit_Framework_TestCase;

/**
 * CityTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CityTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Entity\City::getId
     * @covers \OpenWeatherMap\Entity\City::setId
     */
    public function testGetSetId()
    {
        $id = "2172797";
        $city = new City();

        $this->assertNull($city->getId());
        $this->assertSame($city, $city->setId($id));
        $this->assertEquals($id, $city->getId());
    }

    /**
     * @covers \OpenWeatherMap\Entity\City::getName
     * @covers \OpenWeatherMap\Entity\City::setName
     */
    public function testGetSetName()
    {
        $name = 'Cairns';
        $city = new City();

        $this->assertNull($city->getName());
        $this->assertSame($city, $city->setName($name));
        $this->assertEquals($name, $city->getName());
    }

    /**
     * @covers \OpenWeatherMap\Entity\City::getCoord
     * @covers \OpenWeatherMap\Entity\City::setCoord
     */
    public function testGetSetCoord()
    {
        $coord = new Coord();
        $city = new City();

        $this->assertNull($city->getCoord());
        $this->assertSame($city, $city->setCoord($coord));
        $this->assertSame($coord, $city->getCoord());
    }

    /**
     * Test that we can get and set the country
     *
     * @covers \OpenWeatherMap\Entity\City::getCountry
     * @covers \OpenWeatherMap\Entity\City::setCountry
     */
    public function testGetSetCountry()
    {
        $country = 'AU';
        $city = new City();

        $this->assertNull($city->getCountry());
        $this->assertSame($city, $city->setCountry($country));
        $this->assertEquals($country, $city->getCountry());
    }

    /**
     * @covers \OpenWeatherMap\Entity\City::getSun
     * @covers \OpenWeatherMap\Entity\City::setSun
     */
    public function testGetSetSun()
    {
        $sun = new Sun();
        $city = new City();

        $this->assertNull($city->getSun());
        $this->assertSame($city, $city->setSun($sun));
        $this->assertSame($sun, $city->getSun());
    }
}
