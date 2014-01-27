<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Meta;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Description of MetaStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class MetaStrategy implements StrategyInterface
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
