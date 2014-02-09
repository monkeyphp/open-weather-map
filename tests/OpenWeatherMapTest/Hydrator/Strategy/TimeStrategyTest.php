<?php
/**
 * TimeStrategyTest.php
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

use OpenWeatherMap\Entity\Time;
use OpenWeatherMap\Hydrator\Strategy\TimeStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * TimeStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TimeStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::hydrate
     */
    public function testHydrateWithDailyJson()
    {
        
    }
    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::hydrate
     */
    public function testHydrateWithForecastJson()
    {
        // forecast/london.json
        $temp = 274.976;
        $tempMin = 274.976;
        $tempMax = 274.976;
        $pressure = 989.44;
        $humidity = 95;
        $weatherId = 500;
        $weatherMain = 'Rain';
        $weatherDescription = 'light rain';
        $weatherIcon = '10n';
        $all = 92;
        $speed = 5.85;
        $deg = 182.502;
        //
        $dt = 1391245200;
        $main = array(
            'temp' => $temp,
            'temp_min' => $tempMin,
            'temp_max' => $tempMax,
            'pressure' => $pressure,
            'humidity' => $humidity
        );
        $weather = array(
            array(
                'id' => $weatherId,
                'main' => $weatherMain,
                'description' => $weatherDescription,
                'icon' => $weatherIcon
            )
        );
        $clouds = array('all' => $all);
        $wind = array(
            'speed' => $speed,
            'deg' => $deg
        );
        $snow = array('3h' => 0);
        $rain = array('3h' => 2);
        $sys = array('pod', 'n');
        $dt_txt = "2014-02-01 09:00:00";
        //

        $timeStrategy = new TimeStrategy();

        /* @var $time \OpenWeatherMap\Entity\Time */
        $time = $timeStrategy->hydrate(compact('dt', 'main', 'weather', 'clouds', 'wind', 'snow', 'rain', 'sys', 'dt_txt'));
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Time', $time);

         //day
        $this->assertEquals($dt, $time->getDay());

        /* @var $temparature \OpenWeatherMap\Entity\Temperature */
        $temperature = $time->getTemperature();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Temperature', $temperature);
        $this->assertEquals($temperature->getValue(), $temp);
        $this->assertEquals($temperature->getMin(), $tempMin);
        $this->assertEquals($temperature->getMax(), $tempMax);

        /* @var $temperature \OpenWeatherMap\Entity\Pressure */
        $pressureEntity = $time->getPressure();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Pressure', $pressureEntity);
        $this->assertEquals($pressureEntity->getValue(), $pressure);

        /* @var $humidity \OpenWeatherMap\Entity\Humidity */
        $humidityEntity = $time->getHumidity();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Humidity', $humidityEntity);
        $this->assertEquals($humidityEntity->getValue(), $humidity);

        /* @var $windSpeed \OpenWeatherMap\Entity\WindSpeed */
        $windSpeed = $time->getWindSpeed();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\WindSpeed', $windSpeed);
        $this->assertEquals($windSpeed->getValue(), $speed);

        /* @var $windDirection \OpenWeatherMap\Entity\WindDirection */
        $windDirection = $time->getWindDirection();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\WindDirection', $windDirection);
        $this->assertEquals($windDirection->getValue(), $deg);

        /* @var $clouds \OpenWeatherMap\Entity\Clouds */
        $cloudsEntity = $time->getClouds();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Clouds', $cloudsEntity);
        $this->assertEquals($cloudsEntity->getAll(), $all);

        /* @var $precipitationEntity \OpenWeatherMap\Entity\Precipitation */
        $precipitationEntity = $time->getPrecipitation();
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Precipitation', $precipitationEntity);
        $this->assertEquals($precipitationEntity->getType(), 'rain');
        $this->assertEquals($precipitationEntity->getValue(), 2);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::hydrate
     */
    public function testHydrateWithForecastXml()
    {
        $from = null;
        $to = null;
        $number = 803;
        $name = 'broken clouds';
        $var = '04d';
        $deg = 260.001;
        $code = 'W';
        $windDirectionName = 'West';
        $mps = 1.76;
        $windSpeedName = 'Light Breeze';
        $temperatureUnit = 'celcius';
        $temperatureValue = -22;
        $temperatureMin = -24.356;
        $temperatureMax = -22;
        $pressureUnit = 'hPa';
        $pressureValue = 1006.34;
        $humidityValue = 77;
        $humidityUnit = '%';
        $cloudsValue = 'sky is clear';
        $cloudsAll = 0;
        $cloudsUnit = '%';
        //
        $symbol = array(
            'number' => $number,
            'name' => $name,
            'var' => $var
        );
        $precipitation = array();
        $windDirection = array(
            'deg' => $deg,
            'code' => $code,
            'name' => $windDirectionName
        );
        $windSpeed = array(
            'mps' => $mps,
            'name' => $windSpeedName
        );
        $temperature = array(
            'unit' => $temperatureUnit,
            'value' => $temperatureValue,
            'min' => $temperatureMin,
            'max' => $temperatureMax
        );
        $pressure = array(
            'unit' => $pressureUnit,
            'value' => $pressureValue
        );
        $humidity = array(
            'unit' => $humidityUnit,
            'value' => $humidityValue
        );
        $clouds = array(
            'value' => $cloudsValue,
            'all' => $cloudsAll,
            'unit' => $cloudsUnit
        );
        $timeStrategy = new TimeStrategy();

        /* @var $time \OpenWeatherMap\Entity\Time */
        $time = $timeStrategy->hydrate(compact(
            'symbol',
            'precipitation',
            'windDirection',
            'windSpeed',
            'temperature',
            'pressure',
            'humidity',
            'clouds'));
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Time', $time);

    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $timeStrategy = new TimeStrategy();

        $this->assertNull($timeStrategy->hydrate(new stdClass));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::extract
     */
    public function testExtract()
    {
        $from = '2014-01-26T18:00:00';
        $time = new Time();
        $time->setFrom($from);
        $timeStrategy = new TimeStrategy();

        $array = $timeStrategy->extract($time);

        $this->assertArrayHasKey('from', $array);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\TimeStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $timeStrategy = new TimeStrategy();
        $this->assertNull($timeStrategy->extract(new stdClass()));
    }
}
