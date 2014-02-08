<?php
/**
 * CurrentStrategyTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
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
namespace OpenWeatherMapTest\Hydrator\Strategy;

use OpenWeatherMap\Entity\City;
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Hydrator\Strategy\CurrentStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * CurrentStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CurrentStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Current
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CurrentStrategy::hydrate
     */
    public function testHydrate()
    {
        $city = array();
        $temperature = array();
        $humidity = array();
        $pressure = array();
        $windSpeed = array();
        $windDirection = array();
        $clouds = array();
        $precipitation = array();
        $weather = array();
        $lastUpdate = '';
        $values = array(
            'city' => $city,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'pressure' => $pressure,
            'wind' => array(
                'speed' => $windSpeed,
                'direction' => $windDirection
            ),
            'clouds' => $clouds,
            'precipitation' => $precipitation,
            'weather' => $weather,
            'lastupdate' => array(
                'value'=> $lastUpdate
            )
        );
        $strategy = new CurrentStrategy();

        $current = $strategy->hydrate($values);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Current', $current);
    }

    /**
     * Test that attempting to hydrate using a non array parameter results in null
     * being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CurrentStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new CurrentStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from the supplied Current instance
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CurrentStrategy::extract
     */
    public function testExtract()
    {
        $name = 'Los Angeles,US';
        $city = new City();
        $city->setName($name);

        $current = new Current();
        $current->setCity($city);

        $strategy = new CurrentStrategy();

        $values = $strategy->extract($current);

        $this->assertArrayHasKey('city', $values);
        $this->assertEquals($name, $values['city']['name']);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\CurrentStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new CurrentStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
