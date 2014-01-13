<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Symbol;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Description of SymbolStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class SymbolStrategy implements StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        
    }

    public function hydrate($value)
    {
        return $this->getHydrator()->hydrate($value, new Symbol());
    }
}
