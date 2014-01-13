<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Entity;

/**
 * Description of Meta
 *
 * @author David White <david@monkeyphp.com>
 */
class Meta
{
    protected $lastUpdate;
    
    protected $calcTime;
    
    protected $nextUpdate;
    
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function getCalcTime()
    {
        return $this->calcTime;
    }

    public function getNextUpdate()
    {
        return $this->nextUpdate;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    public function setCalcTime($calcTime)
    {
        $this->calcTime = $calcTime;
        return $this;
    }

    public function setNextUpdate($nextUpdate)
    {
        $this->nextUpdate = $nextUpdate;
        return $this;
    }


}
