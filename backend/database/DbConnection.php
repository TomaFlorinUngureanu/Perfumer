<?php

class DbConnection
{
    private const URL = "localhost/XE";
    private const USER = "student";
    private const PASSWORD = "STUDENT";
    private static $connection = null;

    static public function getDbConnection()
    {
        self::$connection = oci_connect(self::USER,self::PASSWORD, self::URL,'AL32UTF8');
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
