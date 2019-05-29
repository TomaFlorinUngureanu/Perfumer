<?php
/**
 * Created by PhpStorm.
 * User: thomi
 * Date: 5/28/2019
 * Time: 8:53 PM
 */

class DbConnection
{
    private static const URL = "localhost/XE";
    private static const USER = "student";
    private static const PASSWORD = "STUDENT";
    private static $connection = null;

    static public function getDbConnection()
    {
        self::$connection = oci_connect(self::USER,self::PASSWORD, self::URL);
        return self::$connection;
    }

    static public function commitChanges()
    {
        oci_commit(self::$connection);
    }

    static public function rollBackChanges()
    {
        oci_rollback(self::$connection);
    }

    static public function closeConnection()
    {
        oci_close(self::$connection);
    }

}
