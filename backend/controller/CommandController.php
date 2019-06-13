<?php
ob_start();
require_once('PerfumeController.php');

class CommandController
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
    }

    public function sendCommand($userEmail)
    {
        $sqlQuery = 'begin :message := CART_TO_COMANDA(:email); end;';
        $result = '';
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Parsing failed";
        } else
        {
            oci_bind_by_name($stmt,':email',$userEmail);
            oci_bind_by_name($stmt,':message',$result, 400, SQLT_CHR);

            oci_execute($stmt);
            oci_commit($this->conn);
        }

        if($result != 'Succes!')
        {
            return false;
        }

        return true;
    }

    public function printCommandsStatus($userEmail)
    {

        $sqlQuery = 'begin :commandsCursor := afisare_comenzi(:email); end;';
        $commands = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Parsing failed";
        } else
        {
            oci_bind_by_name($stmt, ':commandsCursor', $commands, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':email', $userEmail);
            oci_execute($stmt);
            oci_execute($commands);
        }

        $commandsArray = array();
        while (($row = oci_fetch_array($commands, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceArray, $row);
        }

        for ($i = 0; $i < sizeof($commandsArray); $i++)
        {
            foreach ($commandsArray[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $commandsArray[$i][$key] = $text;
            }
        }

        return true;
    }

    public function getShoppingCart($userEmail)
    {
        if ($userEmail === null)
        {
            echo "<h2>You should login first!</h2>";
            return false;
        }
        $sqlQuery = 'begin :cartCursor := AFISARE_CART(:email); end;';
        $shoppingCart = oci_new_cursor($this->conn);
        if(!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            return false;
        }
        else
        {
            oci_bind_by_name($stmt, ':cartCursor', $shoppingCart, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':email', $userEmail);
            oci_execute($stmt);
            oci_execute($shoppingCart);
        }
        $fragranceArray = array();
        while (($row = oci_fetch_array($shoppingCart, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceArray, $row);
        }

        for ($i = 0; $i < sizeof($fragranceArray); $i++)
        {
            foreach ($fragranceArray[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceArray[$i][$key] = $text;
            }
        }

        return $fragranceArray;
    }

    public function eraseFromShoppingCart($fragranceId, $commandId, $fragranceQuantity, $cost, $email)
    {
        $sqlQuery = 'begin :message := STERGERE_CART(:p_id, :p_idparfum, :p_email, :p_cantitate, :p_cost); end;';
        $resultVar = '';
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Parsing failed";
        } else
        {
            $commandIdInt = intval($commandId);
            $fragranceIdInt = intval($fragranceId);
            $fragranceNumber = intval($fragranceQuantity);
            $costInt = intval($cost);

            oci_bind_by_name($stmt, ':message', $resultVar, 400, SQLT_CHR);
            oci_bind_by_name($stmt, ':p_id', $commandIdInt);
            oci_bind_by_name($stmt, ':p_idparfum', $fragranceIdInt);
            oci_bind_by_name($stmt, ':p_email', $email);
            oci_bind_by_name($stmt, ':p_cantitate', $fragranceNumber);
            oci_bind_by_name($stmt, ':p_cost', $costInt);
            oci_execute($stmt);
        }

        if ($resultVar != 'Succes!')
        {
            return false;
        }

        return $resultVar;
    }

    public function addToShoppingCart(PerfumeModel $perfumeModel, $cost, $amount, $userEmail): bool
    {
        $perfumePicture = null;
        $perfumeName = null;
        $perfumeBrand = null;
        $perfumeQuantity = null;
        $perfumeGender = null;
        $amountInt = null;
        $costInt = null;
        $userEmailUsed = $userEmail;
        $resultVar = '';

        $sqlQuery = 'begin :message := ADAUGARE_CART(:poza, :nume, :brand, :cantitate, :sex, :email, :bucati, :cost); end;';

        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Parsing failed";
        } else
        {
            $perfumePicture = $perfumeModel->getPicture();
            $perfumeName = $perfumeModel->getName();
            $perfumeBrand = $perfumeModel->getBrand();
            $perfumeQuantity = intval($perfumeModel->getQuantity());
            $perfumeGender = intval($perfumeModel->getGender());
            $amountInt = intval($amount);
            $costInt = intval($cost);

            oci_bind_by_name($stmt, ':message', $resultVar, 400, SQLT_CHR);
            oci_bind_by_name($stmt, ':poza', $perfumePicture);
            oci_bind_by_name($stmt, ':nume', $perfumeName);
            oci_bind_by_name($stmt, ':brand', $perfumeBrand);
            oci_bind_by_name($stmt, ':cantitate', $perfumeQuantity);
            oci_bind_by_name($stmt, ':sex', $perfumeGender);
            oci_bind_by_name($stmt, ':email', $userEmailUsed);
            oci_bind_by_name($stmt, ':bucati', $amountInt);
            oci_bind_by_name($stmt, ':cost', $costInt);
            oci_execute($stmt, OCI_NO_AUTO_COMMIT);
            DbConnection::commitChanges();
            
            return true;
        }

        if ($resultVar != 'Succes!')
        {
            var_dump("bla");
            return false;
        }

        return true;
    }

}