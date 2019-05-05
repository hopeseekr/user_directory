<?php

/**
 * User Directory
 *   Copyright (c) 2008, 2019 Theodore R. Smith <theodore@phpexperts.pro>
 *
 * The following code is licensed under a modified BSD License.
 * All of the terms and conditions of the BSD License apply with one
 * exception:
 *
 * 1. Every one who has not been a registered student of the "PHPExperts
 *    From Beginner To Pro" course (http://www.phpexperts.pro/) is forbidden
 *    from modifing this code or using in an another project, either as a
 *    deritvative work or stand-alone.
 *
 * BSD License: http://www.opensource.org/licenses/bsd-license.php
 **/

class MyDBTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers MyDB::loadDB
     */
    public function testLoadAPdoDb()
    {
        $config = MyDatabaseTestSuite::getRealPDOConfig();
        $this->assertInstanceOf('MyPDO', MyDB::loadDB($config));
    }

    /**
     * @covers MyDB::loadDB
     */
    public function testLoadAReplicatedPdoDb()
    {
        $config = MyDatabaseTestSuite::getReplicatedPDOConfig();
        $this->assertInstanceOf('MyReplicatedPDO', MyDB::loadDB($config));
    }
}