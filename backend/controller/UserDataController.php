<?php
class UserDataController
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
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