<?php
/**
 * DailyConnector.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
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
namespace OpenWeatherMap\Connector;

use OpenWeatherMap\Entity\WeatherData;
use OpenWeatherMap\Hydrator\Strategy\CreditStrategy;
use OpenWeatherMap\Hydrator\Strategy\ForecastStrategy;
use OpenWeatherMap\Hydrator\Strategy\LocationStrategy;
use OpenWeatherMap\Hydrator\Strategy\MetaStrategy;
use OpenWeatherMap\Hydrator\Strategy\SunStrategy;
use Zend\Filter\Int;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Validator\Digits;

/**
 * DailyConnector
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class DailyConnector extends AbstractConnector implements DailyConnectorInterface
{
    /**
     * Url param for count
     * 
     * @var string
     */
    const PARAM_COUNT = 'cnt';
    
    /**
     * The defaultCount value
     * 
     * @var int|null
     */
    protected $defaultCount;
    
    /**
     * Url api endpoint
     * 
     * @var string
     */
    protected $endPoint = 'forecast/daily';
    
    public function getStrategy()
    {
        return new ForecastStrategy();
    }
    
    /**
     * Return an instance of InputFilter
     * 
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (! isset($this->inputFilter)) {
            $inputFilter = parent::getInputFilter();
            
            // count
            $count = new Input('count');
            $count->setAllowEmpty(true);
            $count->getFilterChain()->attach(new Int());
            $count->getValidatorChain()->attach(new Digits());
            
            $inputFilter->add($count);
            
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    /**
     * Return the defaultCount value
     * 
     * This method will set the defaultCount to 7 if it is not already set
     * 
     * @return int
     */
    public function getDefaultCount()
    {
        if (! isset($this->defaultCount)) {
            $this->defaultCount = 7;
        }
        return $this->defaultCount;
    }
    
    /**
     * Set the defaultCount value
     * 
     * @param int|null $defaultCount
     * 
     * @return DailyConnector
     */
    public function setDefaultCount($defaultCount = null)
    {
        $this->defaultCount = $defaultCount;
        return $this;
    }
    
    /**
     * Return an array of default options
     * 
     * @return array
     */
    public function getDefaultOptions()
    {
        return parent::getDefaultOptions() + 
                array('count' => $this->getDefaultCount());
    }
    
    /**
     * Parse the supplied options into an array of url params
     * 
     * @param array $options
     * 
     * @return array
     */
    public function parseParams($options = array())
    {
        $params = parent::parseParams($options);
        
        if (isset($options['count'])) {
            $params[self::PARAM_COUNT] = $options['count'];
        }
        
        return $params;
    }
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getDaily($options = array())
    {
        return parent::query($options);
    }
}
