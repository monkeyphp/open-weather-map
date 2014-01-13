<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;
/**
 * Description of LatitudeStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class LongitudeStrategy implements \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
{
    
    public function extract($value)
    {
        return $value;
    }

    public function hydrate($value)
    {   
        return $value;
    }

}
