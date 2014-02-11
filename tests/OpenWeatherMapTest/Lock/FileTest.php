<?php
/**
 * FileTest.php
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

use OpenWeatherMap\Lock\File;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit_Framework_TestCase;

/**
 * FileTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Lock
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 *
 * @group filelock
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can create an instance
     *
     * @covers \OpenWeatherMap\Lock\File::__construct
     */
    public function test__construct()
    {
        $lock = new File('my.lock');

        $this->assertInstanceOf('\OpenWeatherMap\Lock\LockInterface', $lock);
    }

    /**
     * Test that we can successfully acquire a lock
     *
     * @covers \OpenWeatherMap\Lock\File::acquire
     */
    public function testAcquire()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new File(array('file' => $file));

        $this->assertFalse($vfs->hasChild('my.lock'));
        $this->assertTrue($lock->acquire());
        $this->assertTrue($vfs->hasChild('my.lock'));

        // test that the file contains something
        $contents = file_get_contents($file);
        $this->assertInternalType('string', $contents);
    }

    /**
     * Test that we can successfully unlock a simple lock
     *
     * @covers \OpenWeatherMap\Lock\File::release
     */
    public function testRelease()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new File(array('file' => $file));

        $this->assertFalse($vfs->hasChild('my.lock'));

        $this->assertTrue($lock->acquire());
        $this->assertTrue($vfs->hasChild('my.lock'));
        $this->assertTrue($lock->release());
        $this->assertTrue($vfs->hasChild('my.lock'));
    }

    /**
     * Test that we can aquire several successive locks
     *
     * @covers \OpenWeatherMap\Lock\File::acquire
     * @covers \OpenWeatherMap\Lock\File::release
     */
    public function testAquireSuccessiveLocks()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $lock = new File(
            array(
                'file' => $file,
                'minlifetime' => 1,
                'maxlifetime' => 10,
            )
        );

        $content = null;
        $this->assertFalse($vfs->hasChild('my.lock'));

        for ($i = 0; $i < 5; $i++) {
            $this->assertTrue($lock->acquire());
            sleep(2);
            $this->assertTrue($lock->release());
            $contents = file_get_contents($file);
            $this->assertInternalType('string', $contents);

            $this->assertNotSame($contents, $content);
            $content = $contents;
        }
        $this->assertTrue($vfs->hasChild('my.lock'));
    }

    /**
     * Test that we can set the file
     */
//    public function testSetFile()
//    {
//        $vfs = vfsStream::setup('exampleDir');
//        $file = vfsStream::url('exampleDir/my.lock');
//        $lock = new File(array('file' => $file));
//
//        $this->assertEquals($file, $lock->getFile());
//    }

    /**
     * Test that supplying a file path that is not readable results
     * in an exception being thrown
     */
//    public function testSetFileThrowsException()
//    {
//        $vfs = vfsStream::setup('exampleDir');
//        $dir = new vfsStreamDirectory('temp', 700);
//        $dir->chown(99);
//        $dir->chgrp(99);
//        $vfs->addChild($dir);
//        $file = vfsStream::url('exampleDir/temp/my.lock');
//
//        $this->setExpectedException('Exception');
//
//        $lock = new File(array('file' => $file));
//    }





    /**
     * Test that attempting to obtain a lock before the min lock life time
     * results in false being returned
     *
     * @group foo
     * @covers \OpenWeatherMap\Lock\File::acquire
     */
    public function testLockReturnsFalseIfCurrentTimeLessThanMinimum()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $minLifetime = 100;
        $lock = new File(array('file' => $file, 'minlifetime' => $minLifetime));

        $this->assertSame($minLifetime, $lock->getMinLifetime());

        $this->assertTrue($lock->acquire());
        $this->assertTrue($lock->release());
        $this->assertFalse($lock->acquire());
    }

    /**
     * Test that we can obtain the lock if the current lock has exceeded the
     * maximum lifetime
     *
     * @covers \OpenWeatherMap\Lock\File::acquire
     */
    public function testLockIsUnlockedIfCurrentLockAgeIsGreaterThanMaxium()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $maxLifetime = 2;
        $lock = new File(array('file' => $file, 'maxlifetime' => $maxLifetime));

        $this->assertEquals($maxLifetime, $lock->getMaxLifetime());
        $this->assertTrue($lock->acquire());
        sleep(3);
        $this->assertTrue($lock->acquire());
    }

    /**
     * Test attempting to call lock multiple times
     *
     * Test that if we attempt to call lock before the lock has been release
     * results false being returned
     *
     * @covers \OpenWeatherMap\Lock\File::acquire
     */
    public function testMultipleLocks()
    {
        $vfs = vfsStream::setup('exampleDir');
        $file = vfsStream::url('exampleDir/my.lock');
        $maxLifetime = 20;
        $minLifetime = 10;
        $lock = new File(array(
            'file'        => $file,
            'maxlifetime' => $maxLifetime,
            'minlifetime' => $minLifetime
        ));

        $this->assertTrue($lock->acquire());
        $this->assertFalse($lock->acquire());
    }
}
