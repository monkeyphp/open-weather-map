<?php
/**
 * TimeStrategy.php
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
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
namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Time;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * TimeStrategy
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TimeStrategy implements StrategyInterface
{
    /**
     * Instance of ClassMethods hydrator
     *
     * @var ClassMethods
     */
    protected $hydrator;

    /**
     * Return an instance of ClassMethods hydrator
     *
     * @return ClassMethods
     */
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('symbol', new SymbolStrategy());
            $hydrator->addStrategy('precipitation', new PrecipitationStrategy());
            $hydrator->addStrategy('windDirection', new WindDirectionStrategy());
            $hydrator->addStrategy('windSpeed', new WindSpeedStrategy());
            $hydrator->addStrategy('temperature', new TemperatureStrategy());
            $hydrator->addStrategy('pressure', new PressureStrategy());
            $hydrator->addStrategy('humidity', new HumidityStrategy());
            $hydrator->addStrategy('clouds', new CloudsStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }

    /**
     * Extract the values from the supplied instance of Time
     *
     * @param Time $value The Time instance to extract values from
     *
     * @return null
     */
    public function extract($value)
    {
        if (! $value instanceof Time) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    /**
     * Hydrate and return an instance of Time using the supplied value array
     *
     * This method has to handle the differences between the array of values that
     * are returned from each of the different modes (xml, json).
     * So we create a temporary array and populate with the correct keys and
     * values from the supplied array of values.
     *
     * This method does a lot of 'if' checking :)
     *
     * @param array $value The array of values to hydrate the Time instance with
     *
     * @return Time
     */
    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }

        $tmp = array(
            'symbol' => null,
            'precipitation' => null,
            'windDirection' => null,
            'windSpeed' => null,
            'temperature' => null,
            'pressure' => null,
            'humidity' => null,
            'clouds' => null,
            'day' => null,
            'from' => null,
            'to' => null
        );

        if (isset($value['symbol'])) {
            $tmp['symbol'] = $value['symbol'];
            unset($value['symbol']);
        }

        if (isset($value['precipitation'])) {
            $tmp['precipitation'] = $value['precipitation'];
            unset($value['precipitation']);
        }

        if (isset($value['windSpeed'])) {
            $tmp['windSpeed'] = $value['windSpeed'];
            unset($value['windSpeed']);
        }

        if (isset($value['windDirection'])) {
            $tmp['windDirection'] = $value['windDirection'];
            unset($value['windDirection']);
        }

        if (isset($value['wind']) && is_array($value['wind'])) {
            $wind = $value['wind'];
            if (isset($wind['speed'])) {
                $tmp['windSpeed'] = array('mps' => $wind['speed']);
            }
            if (isset($wind['deg'])) {
                $tmp['windDirection'] = array('deg' => $wind['deg']);
            }
            unset($value['wind']);
        }

        if (isset($value['temperature'])) {
            $tmp['temperature'] = $value['temperature'];
            unset($value['temperature']);
        }

        if (isset($value['pressure'])) {
            $pressure = $value['pressure'];
            if (! is_array($pressure)) {
                $pressure = array('value' => $pressure);
            }
            $tmp['pressure'] = $pressure;
            unset($value['pressure']);
        }

        if (isset($value['humidity'])) {
            $humidity = $value['humidity'];
            if (! is_array($humidity)) {
                $humidity = array('value' => $humidity);
            }
            $tmp['humidity'] = $humidity;
            unset($value['humidity']);
        }

        if (isset($value['clouds'])) {
            $clouds = $value['clouds'];
            if (! is_array($value['clouds'])) {
                $clouds = array('all' => $clouds);
            }
            $tmp['clouds'] = $clouds;
            unset($value['clouds']);
        }

        if (isset($value['day'])) {
            $tmp['day'] = $value['day'];
            unset($value['day']);
        }

        if (isset($value['from'])) {
            $tmp['from'] = $value['from'];
            unset($value['from']);
        }

        if (isset($value['to'])) {
            $tmp['to'] = $value['to'];
            unset($value['to']);
        }

        if (isset($value['dt'])) {
            $tmp['day'] = $value['dt'];
            unset($value['dt']);
        }

        if (isset($value['main']) && is_array($value['main'])) {

            $main = $value['main'];

            if ((isset($main['temp']) ||
                isset($main['temp_min']) ||
                isset($main['temp_max'])) &&
                ! isset($tmp['temperature'])
            ) {
                if (! is_array($tmp['temperature'])) {
                    $tmp['temperature'] = array();
                }

                if (isset($main['temp'])) {
                    $tmp['temperature']['value'] = $main['temp'];
                }

                if (isset($main['temp_min'])) {
                    $tmp['temperature']['min'] = $main['temp_min'];
                }

                if (isset($main['temp_max'])) {
                    $tmp['temperature']['max'] = $main['temp_max'];
                }
            }

            if (isset($main['pressure'])) {
                $tmp['pressure'] = array('value' => $main['pressure']);
            }

            if (isset($main['humidity'])) {
                $tmp['humidity'] = array('value' => $main['humidity']);
            }
            // @todo sea_level
            // @todo grnd_level
            unset($value['main']);
        }

        if (isset($value['weather'])) {
            $weather = $value['weather'];
            if (is_array($weather)) {
                foreach ($weather as $index => $data) {
                    if (is_array($data)) {
                        if (isset($data['id'])) {
                            if (! is_array($tmp['symbol'])) {
                                $tmp['symbol'] = array();
                            }
                            $tmp['symbol']['number'] = $data['id'];
                        }
                        if (isset($data['description'])) {
                            if (! is_array($tmp['clouds'])) {
                                $tmp['clouds'] = array();
                            }
                            $tmp['clouds']['value'] = $data['description'];
                        }
                        if (isset($data['icon'])) {
                            if (! is_array($tmp['symbol'])) {
                                $tmp['symbol'] = array();
                            }
                            $tmp['symbol']['icon'] = $data['icon'];
                        }
                        break;
                    }
                }
                unset($index);
                unset($data);
            }
            unset($weather);
            unset($value['weather']);
        }

        if (isset($value['snow']) || isset($value['rain'])) {

            if (! is_array($tmp['precipitation'])) {
                $tmp['precipitation'] = array();
            }

            $snow = $rain = array('type' => null, 'unit' => null, 'value' => null);
            $snow['type'] = 'snow';
            $rain['type'] = 'rain';

            if (isset($value['snow'])) {
                if (is_array($value['snow'])) {
                    $keys = each($value['snow']);
                    $snow['unit'] = isset($keys['unit']) ? $keys['unit'] : null;
                    $snow['value'] = isset($keys['value']) ? $keys['value'] : null;
                } else {
                    $snow['value'] = $value['snow'];
                }
            }
            if (isset($value['rain'])) {
                if (is_array($value['rain'])) {
                    $keys = each($value['rain']);
                    $rain['unit'] = isset($keys['unit']) ? $keys['unit'] : null;
                    $rain['value'] = isset($keys['value']) ? $keys['value'] : null;
                } else {
                    $rain['value'] = $value['rain'];
                }
            }
            $tmp['precipitation'] = ($snow['value'] < $rain['value']) ? $rain : $snow;
        }

        if (isset($value['temp'])) {
            $temp = $value['temp'];

            if (! is_array($tmp['temperature'])) {
                $tmp['temperature'] = array();
            }

            $temperature = array(
                'day' => (isset($temp['day'])) ? $temp['day'] : null,
                'min' => (isset($temp['min'])) ? $temp['min'] : null,
                'max' => (isset($temp['max'])) ? $temp['max'] : null,
                'night' => (isset($temp['night'])) ? $temp['night'] : null,
                'evening' => (isset($temp['eve'])) ? $temp['eve'] : null,
                'morning' => (isset($temp['morn'])) ? $temp['morn'] : null
            );
            $tmp['temperature'] = $temperature;

            unset($value['temp']);
        }

        if (isset($value['speed'])) {
            $speed = $value['speed'];
            if (! is_array($speed)) {
                $speed = array('mps' => $speed);
            }
            $tmp['windSpeed'] = $speed;
            unset($value['speed']);
        }

        if (isset($value['deg'])) {
            $direction = $value['deg'];
            if (! is_array($direction)) {
                $direction = array('deg' => $direction);
            }
            $tmp['windDirection'] = $direction;
            unset($value['deg']);
        }

        return $this->getHydrator()->hydrate($tmp, new Time());
    }
}
