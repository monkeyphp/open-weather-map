<?php
/**
 * ForecastStrategyTest.php
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

use OpenWeatherMap\Hydrator\Strategy\ForecastStrategy;
use PHPUnit_Framework_TestCase;

/**
 * ForecastStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ForecastStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrate()
    {
        $value = array('time' => array());
        $strategy = new ForecastStrategy();

        $forecast = $strategy->hydrate($value);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Forecast', $forecast);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrateWithNullValue()
    {
        $value = null;
        $strategy = new ForecastStrategy();

        $this->assertNull($strategy->hydrate($value));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrateWithObject()
    {
        $value = new \stdClass();
        $strategy = new ForecastStrategy();

        $this->assertNull($strategy->hydrate($value));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrateWithEmptyArray()
    {
        $value = array();
        $strategy = new ForecastStrategy();

        $forecast = $strategy->hydrate($value);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Forecast', $forecast);

    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrateWithString()
    {
        $value = 'fooBarEggsHam';
        $strategy = new ForecastStrategy();

        $this->assertNull($strategy->hydrate($value));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\ForecastStrategy::hydrate
     */
    public function testHydrateWithInvalidTimeValue()
    {
        $value = array('time' => new \stdClass());
        $strategy = new ForecastStrategy();

        $forecast = $strategy->hydrate($value);

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Forecast', $forecast);
        $this->assertEmpty($forecast->getTimes());
    }

    public function testHydrateWithTimes()
    {
        $this->markTestIncomplete();
        
        $times = array(
            array(
                'symbol' => array(
                    'number' => '803'
                )
            )
        );
        $values = array('times' => $times);
    }
}
