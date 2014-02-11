<?php
/**
 * MetaStrategy.php
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

use OpenWeatherMap\Entity\Meta;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * MetaStrategy
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class MetaStrategy implements StrategyInterface
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
            $this->hydrator = new ClassMethods(false);
        }
        return $this->hydrator;
    }

    /**
     * Extract the values from the supplied Meta instance
     *
     * @param Meta $value
     *
     * @return null|array
     */
    public function extract($value)
    {
        if (! $value instanceof Meta) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    /**
     * Hydrate an instance of Meta using the supplied array of values
     *
     * @param array $value The array of values
     *
     * @return null|Meta
     */
    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }
        if (isset($value['lastupdate'])) {
            $value['lastUpdate'] = $value['lastupdate'];
            unset($value['lastupdate']);
        }
        if (isset($value['calctime'])) {
            $value['calcTime'] = $value['calctime'];
            unset($value['calctime']);
        }
        if (isset($value['nextupdate'])) {
            $value['nextUpdate'] = $value['nextupdate'];
            unset($value['nextupdate']);
        }
        return $this->getHydrator()->hydrate($value, new Meta());
    }
}
