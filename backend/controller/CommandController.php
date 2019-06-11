<?php
require_once('PerfumeController.php');

class CommandController
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
    }

    public function getAllCommands()
    {
        if (func_num_args() == 0)
        {
            //get all the commands. ADMIN TO USE
        } else if (func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //get all the commands OF THE USER'S EMAIL IN THE PARAMETER
        } else
        {
            //error code, number of arguments to large
        }
    }

    public function getDeliveredCommnds($userEmail)
    {
        if (func_num_args() == 0)
        {
            //get all the delivered commands. ADMIN TO USE
        } else if (func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //prepared statement FOR USER to get all the commands that have been delivered
        } else
        {
            //error code, number of arguments to large
        }

    }

    public function getOngoingCommands($userEmail)
    {
        if (func_num_args() == 0)
        {
            //get all the ongoing commands. ADMIN TO USE
        } else if (func_num_args() == 1)
        {
            //check for userEmail correctness in the parameter
            //prepared statement for USER to get all the commands that are ongoing
        } else
        {
            //error code, number of arguments to large
        }
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
        $stmt = oci_parse($this->conn, $sqlQuery);
        oci_bind_by_name($stmt, ':cartCursor', $shoppingCart, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ':email', $userEmail);
        oci_execute($stmt);
        oci_execute($shoppingCart);
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

            oci_commit($this->conn);
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