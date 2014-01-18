<?php
/**
 * LockTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Lock
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
namespace OpenWeatherMapTest\Lock;

use OpenWeatherMap\Lock\Lock;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit_Framework_TestCase;

/**
 * LockTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Lock
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class LockTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can create an instance
     */
    public function test__construct()
    {
        $lock = new Lock('my.lock');
        
        $this->assertInstanceOf('\OpenWeatherMap\Lock\LockInterface', $lock);
    }
    
    /**
     * Test that we can set the file
     */
    public function testSetFile()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new Lock($file);
        
        $this->assertEquals($file, $lock->getFile());
    }
    
    /**
     * Test that supplying a file path that is not readable results
     * in an exception being thrown
     */
    public function testSetFileThrowsException()
    {
        $vfs = vfsStream::setup('exampleDir');
        $dir = new vfsStreamDirectory('temp', 700);
        $dir->chown(99);
        $dir->chgrp(99);
        $vfs->addChild($dir);
        $file = vfsStream::url('exampleDir/temp/my.lock');
        
        $this->setExpectedException('Exception');
        
        $lock = new Lock($file);
    }
    
    /**
     * Test that we can successfully get a simple lock
     */
    public function testGetLock()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new Lock($file);
        
        $this->assertTrue($lock->lock());
        $this->assertTrue($vfs->hasChild('my.lock'));
    }
    
    /**
     * Test that we can successfully unlock a simple lock
     */
    public function testUnlock()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new Lock($file);
        
        $this->assertTrue($lock->lock());
        $this->assertTrue($vfs->hasChild('my.lock'));
        $this->assertTrue($lock->unlock());
    }
    
    /**
     * Test that attempting to obtain a lock before the min lock life time
     * results in false being returned
     */
    public function testLockReturnsFalseIfCurrentTimeLessThanMinimum()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $minLifetime = 100;
        $lock = new Lock($file, array('minlifetime' => $minLifetime));
        
        $this->assertSame($minLifetime, $lock->getMinLifetime());
        $this->assertTrue($lock->lock());
        $this->assertTrue($lock->unlock());
        
        $this->assertFalse($lock->lock());
    }
    
    /**
     * Test that we can obtain the lock if the current lock has exceeded the 
     * maximum lifetime
     */
    public function testLockIsUnlockedIfCurrentLockAgeIsGreaterThanMaxium()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $maxLifetime = 2;
        $lock = new Lock($file, array('maxlifetime' => $maxLifetime));
        
        $this->assertEquals($maxLifetime, $lock->getMaxLifetime());
        $this->assertTrue($lock->lock());
        sleep(3);
        $this->assertTrue($lock->lock());
    }
    
    /**
     * Test attempting to call lock multiple times
     */
    public function testMultipleLocks()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $maxLifetime = 2;
        $minLifetime = 1;
        $lock = new Lock($file, array(
            'maxlifetime' => $maxLifetime,
            'minlifetime' => $minLifetime
        ));
        
        $this->assertTrue($lock->lock());
        $this->assertFalse($lock->lock());
    }
}
