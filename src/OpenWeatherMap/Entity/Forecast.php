<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Entity;

/**
 * Description of Forecast
 *
 * @author David White <david@monkeyphp.com>
 */
class Forecast
{
    protected $times;
    
    public function addTime(Time $time)
    {
        $this->times[] = $time;
        return $this;
    }
    
    public function getTimes()
    {
        return $this->time;
    }

    public function setTimes($times = array())
    {
        if (is_array($times) || ($times instanceof \Traversable)) {
            foreach ($times as $time) {
                if ($time instanceof Time) {
                    $this->addTime($time);
                }
            }
        }
        return $this;
    }
}
