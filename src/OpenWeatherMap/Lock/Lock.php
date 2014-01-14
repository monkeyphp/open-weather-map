<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Lock;
/**
 * Description of Lock
 *
 * @author David White <david@monkeyphp.com>
 */
class Lock implements LockInterface
{
    /**
     * Instance of Lock
     * 
     * @var Lock
     */
    protected static $instance;
    
    /**
     * Name of the lock file
     * 
     * @var string|null
     */
    protected $lockFile;
    
    /**
     * Handle to the lock file
     * 
     * @var resource
     */
    protected $handle;
    
    /**
     * Boolean representing the current status of the lock
     * 
     * @var boolean
     */
    protected $locked;
    
    protected $maxLockLifetime = 10; // seconds
    
    protected $lockCreatedTime;
    
    /**
     * @link http://php.net/manual/de/language.oop5.patterns.php
     * @return type
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
   
    public function reset()
    {
        self::$instance = null;
    }
    
    public function setLockFile($lock)
    {
        $this->lockFile = $lock;
        return $this;
    }
    
    public function setMaxLockLifeTime($seconds = 10)
    {
        $this->maxLockLifetime = $seconds;
        return $this;
    }
    
    public function lock()
    {   
        if (! isset($this->handle)) {
            if (false === ($this->handle = fopen($this->lockFile, 'a'))) {
                return false;
            }
        }
        
        $currentTime = microtime(true);
        
        $lockAge = $currentTime - $this->lockCreatedTime;
        
        if ($this->locked && ($this->maxLockLifetime < $lockAge)) {
            $this->unlock();
        }

        if (! $this->locked) {
            if (flock($this->handle, LOCK_EX | LOCK_NB)) {
                $this->locked = true;
                $this->lockCreatedTime = $currentTime;
                return $this->locked;
            }
        }
        
        return false;
    }

    public function unlock()
    {
        if ($this->locked) {
            $this->locked = !flock($this->handle, LOCK_UN);
        }
        return $this->locked;
    }
    
    protected function __construct()
    {
        // no constructor here
    }
    
    protected function __clone()
    {
        // no cloning here
    }
    
    protected function __wakeup()
    {
        // no wakeup here
    }
    
    

    
}
