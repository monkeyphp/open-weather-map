<?php
/**
 * Temperature.php
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
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
namespace OpenWeatherMap\Entity;

use InvalidArgumentException;

/**
 * Temperature
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class Temperature
{
    /**
     * Daytime temperature
     *
     * @var string|null
     */
    protected $day;

    /**
     * Low temperature
     *
     * @var string|null
     */
    protected $min;

    /**
     * Max temperature
     *
     * @var string|null
     */
    protected $max;

    /**
     * Night time temperature
     *
     * @var string|null
     */
    protected $night;

    /**
     * Evening temperature
     *
     * @var string|null
     */
    protected $evening;

    /**
     * Morning temperature
     *
     * @var string|null
     */
    protected $morning;

    /**
     * Temperature (as used in Weather)
     *
     * @var string|null
     */
    protected $value;

    /**
     * Unit measurement
     *
     * @example "kelvin"
     *
     * @var string|null
     */
    protected $unit;

    /**
     * Return the value of the Temperature
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the min temperature
     *
     * @return string|null
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Return the max temperature
     *
     * @return string|null
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Return the unit that the temperatures are measured in
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value
     *
     * @param string|int|float|null $value
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setValue($value = null)
    {
        if (! is_null($value)) {
            if (is_scalar($value) && is_numeric($value)) {
                $value = (float)$value;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($value) . ' supplied'
                );
            }
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Set the min value
     *
     * @param string|null $min
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setMin($min = null)
    {
        if (! is_null($min)) {
            if (is_scalar($min) && is_numeric($min)) {
                $min = (float)$min;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric. ' . gettype($min) . ' supplied'
                );
            }
        }
        $this->min = $min;
        return $this;
    }

    /**
     * Set the max value
     *
     * @param string|null $max
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setMax($max = null)
    {
        if (! is_null($max)) {
            if (is_scalar($max) && is_numeric($max)) {
                $max = (float)$max;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($max) . ' supplied'
                );
            }
        }
        $this->max = $max;
        return $this;
    }

    /**
     * Set the unit of measurement
     *
     * @example "kelvin"
     *
     * @param string|null $unit
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setUnit($unit = null)
    {
        if (! is_null($unit)) {
            if (! is_string($unit)) {
                throw new InvalidArgumentException(
                    'Expects a string. ' . gettype($unit) . ' supplied'
                );
            }
        }
        $this->unit = $unit;
        return $this;
    }

    /**
     * Return the day time temperature
     *
     * @return string|null
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Return the evening temperature
     *
     * @return string|null
     */
    public function getEvening()
    {
        return $this->evening;
    }

    /**
     * Return the morning temperature value
     *
     * @return string|null
     */
    public function getMorning()
    {
        return $this->morning;
    }

    /**
     * Set the daytime temperature
     *
     * @param string|int|float|null $day
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setDay($day = null)
    {
        if (! is_null($day)) {
            if (is_scalar($day) && is_numeric($day)) {
                $day = (float) $day;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($day) . ' supplied'
                );
            }
        }
        $this->day = $day;
        return $this;
    }

    /**
     * Set the evening temperature value
     *
     * @param string|float|int|null $evening
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setEvening($evening = null)
    {
        if (! is_null($evening)) {
            if (is_scalar($evening) && is_numeric($evening)) {
                $evening = (float) $evening;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($evening) . ' supplied'
                );
            }
        }
        $this->evening = $evening;
        return $this;
    }

    /**
     * Set the morning temperature
     *
     * @param string|int|float|null $morning
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setMorning($morning = null)
    {
        if (! is_null($morning)) {
            if (is_scalar($morning) && is_numeric($morning)) {
                $morning = (float) $morning;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($morning) . ' supplied'
                );
            }
        }
        $this->morning = $morning;
        return $this;
    }

    /**
     * Return the night time temperature
     *
     * @return float|null
     */
    public function getNight()
    {
        return $this->night;
    }

    /**
     * Set the night time temperature
     *
     * @param string|int|float|null $night
     *
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setNight($night = null)
    {
        if (! is_null($night)) {
            if (is_scalar($night) && is_numeric($night)) {
                $night = (float) $night;
            } else {
                throw new InvalidArgumentException(
                    'Expects a numeric value. ' . gettype($night) . ' supplied'
                );
            }
        }
        $this->night = $night;
        return $this;
    }
}
