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

use Exception;
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
    
    /**
     * Return an instance of HydratorInterface
     * 
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('location', new LocationStrategy());
            $hydrator->addStrategy('credit', new CreditStrategy());
            $hydrator->addStrategy('meta', new MetaStrategy());
            $hydrator->addStrategy('sun', new SunStrategy());
            $hydrator->addStrategy('forecast', new ForecastStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
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
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getDaily($options = array())
    {
        $options = array_merge($this->getDefaultOptions(), $options);
        $inputFilter = $this->getInputFilter()->setData($options);
        
        if (! $inputFilter->isValid($options)) {
            return $inputFilter->getMessages();
        }
        
        $options = $inputFilter->getValues();
        
        $params = array(
            self::PARAM_MODE     => $options['mode'],
            self::PARAM_UNITS    => $options['units'],
            self::PARAM_LANGUAGE => $options['language'],
            self::PARAM_COUNT    => $options['count'],
            self::PARAM_APPID    => $options['apiKey'],
        );
        
        if (isset($options['query'])) {
            $params[self::PARAM_QUERY] = $options['query'];
        } elseif (isset($options['latitude']) && isset($options['longitude'])) {
            $params[self::PARAM_LATITUDE]  = $options['latitude'];
            $params[self::PARAM_LONGITUDE] = $options['longitude'];
        } else if (isset($options['id'])) {
            $params[self::PARAM_ID] = $options['id'];
        } else {
            throw new Exception('A required value was not supplied');
        }
        
        $request = $this->getRequest($this->getUri(), $params);
        
        $response = $this->getHttpClient()->dispatch($request);
        
        $body = $response->getBody();
        
        $data = $this->getReader($options['mode'])->fromString($body);
        
        $weatherData = new WeatherData();
        
        $this->getHydrator()->hydrate($data, $weatherData);
        
        return $weatherData;
    }
}
