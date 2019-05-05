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

require_once __DIR__ . '/MyDatabaseTestSuite.php';

class MyDBHelperFunctionsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests getDBHandler()
     *
     * @covers MyDBException
     */
    public function testGetDbHandler()
    {
        // Test with a missing config file
        try
        {
            getDBHandler();
        }
        catch (MyDBException $e)
        {
            $this->assertEquals(MyDBException::CANT_LOAD_CONFIG_FILE, $e->getCode());
        }

        // Test create MyDB from scratch
        // (change current directory to be able to find config path)
        chdir(dirname(__FILE__) . '/..');
        $pdo = getDBHandler();
        $this->assertInstanceOf('MyDBI', $pdo, 'PDO object is not of type PDO');;

        // Test with custom config
        $config = MyDatabaseTestSuite::getPDOConfig();
        $new_pdo = getDBHandler($config);
        $this->assertInstanceOf('MyDBI', $new_pdo, 'PDO object is not of type PDO');;
    }

    /**
     * Tests queryDB()
     */
    public function testQueryDb()
    {
        $config = MyDatabaseTestSuite::getRealPDOConfig();
        getDBHandler($config);

        // Test insert
        $username = uniqid();
        queryDB('INSERT INTO Users (username, password) VALUES (\'' . $username . '\', \'' . uniqid() . '\')');

        // Test select w/o parameters
        $stmt = queryDB('SELECT * FROM Users WHERE username=\'' . $username . '\'');
        $userInfo = $stmt->fetchObject();
        $this->assertNotNull($userInfo, 'Unsuccessful query');
        $this->assertSame($username, $userInfo->username);

        // Test select w/ parameters
        $stmt = queryDB('SELECT * FROM Users WHERE username=?', array($username));
        $userInfo = $stmt->fetchObject();
        $this->assertNotNull($userInfo, 'Unsuccessful query');
        $this->assertSame($username, $userInfo->username);

        // Test select w/ malformed SQL
        $this->expectException('MyDBException');
        $stmt = @queryDB('SELECT * FROM usersasdf WHERE username=?', array($username));
    }
}
