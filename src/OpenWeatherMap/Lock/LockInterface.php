<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Lock;
/**
 *
 * @author David White <david@monkeyphp.com>
 */
interface LockInterface
{
    
    public function lock();
    
    public function unlock();
}
