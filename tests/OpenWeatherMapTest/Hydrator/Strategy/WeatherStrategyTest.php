<?php
/**
 * WeatherStrategyTest.php
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

use OpenWeatherMap\Entity\Weather;
use OpenWeatherMap\Hydrator\Strategy\WeatherStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * WeatherStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Weather
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\WeatherStrategy::hydrate
     */
    public function testHydrate()
    {
        $number = 801;
        $value = 'few clouds';
        $icon = '02d';
        $strategy = new WeatherStrategy();

        $weather = $strategy->hydrate(compact('number', 'value', 'icon'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Weather', $weather);
        $this->assertEquals($weather->getNumber(), $number);
        $this->assertEquals($weather->getValue(), $value);
        $this->assertEquals($weather->getIcon(), $icon);
    }

    /**
     * Test that attempting to call hydrate with a non array parameter results
     * in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\WeatherStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new WeatherStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Weather
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\WeatherStrategy::extract
     */
    public function testExtract()
    {
        $number = 801;
        $value = 'few clouds';
        $icon = '02d';
        $weather = new Weather();
        $weather->setNumber($number)->setValue($value)->setIcon($icon);
        $strategy = new WeatherStrategy();

        $values = $strategy->extract($weather);

        $this->assertArrayHasKey('number', $values);
        $this->assertArrayHasKey('value', $values);
        $this->assertArrayHasKey('icon', $values);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WeatherStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new WeatherStrategy();
        
        $this->assertNull($strategy->extract(new stdClass()));
    }
}
