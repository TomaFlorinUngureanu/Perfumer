<?php
class UserDataController
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
    }

    public function getUserCommands($email) : array
    {
        $commandsCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := afisare_comenzi(:p_email); end;')))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $commandsCursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':p_email', $email);
            oci_execute($stmt);
            oci_execute($commandsCursor);
        }

        $commandsList = array();
        while (($row = oci_fetch_array($commandsCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($commandsList, $row);
        }

        for ($i = 0; $i < sizeof($commandsList); $i++)
        {
            foreach ($commandsList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $commandsList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($commandsCursor);
        return $commandsList;
    }


    public function updateUserData($email, $address, $occasion, $note, $season)
    {
        $resultVar = '';
        if (!($stmt = oci_parse($this->conn,
            'begin :result := setare_client(:email, :deliveryAddress, :occasion, :note, :season); end;')))
        {
            echo "Updating user failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $resultVar, 400, SQLT_CHR);
            oci_bind_by_name($stmt, ':email', $email);
            oci_bind_by_name($stmt, ':deliveryAddress', $address);
            oci_bind_by_name($stmt, ':occasion', $occasion);
            oci_bind_by_name($stmt, ':note', $note);
            oci_bind_by_name($stmt, ':season', $season);
            oci_execute($stmt,OCI_NO_AUTO_COMMIT);
            oci_commit($this->conn);
        }

        if ($resultVar != 'Succes!')
        {
            return false;
        }

        return true;
    }
}