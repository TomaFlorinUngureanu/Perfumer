<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
ini_set("default_charset", 'utf-8');

class PerfumeController
{
    private const label = "<label class=\"container\">";
    private const checkBox = "<input type=\"checkbox\" ";
    private const span = "<span class=\"checkmark\"></span></label>";
    private $conn;

    /**
     * PerfumeController constructor.
     */
    public function __construct()
    {
        $this->conn = DbConnection::getDbConnection();
    }

    public function getMinMaxPriceSliders($order): int
    {
        $sqlQuery = 'select * from (select TO_NUMBER(pret) from parfumuri group by TO_NUMBER(pret) 
                    order by TO_NUMBER(pret) ' . $order . ') where rownum=1';
        $price = null;
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_execute($stmt);
            $price = implode(" ", oci_fetch_row($stmt));
        }

        $price = intval($price);

        return $price;
    }

    public function getFragrancesByName($fragranceName)
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := lista_parfumuri_nume(:p_fragranceName); end;')))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':p_fragranceName', $fragranceName);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function getSingleSpecificFragrance($fragranceId)
    {
        $sqlQuery = 'select * from parfumuri where id=' . $fragranceId;
        $fragranceArray = array();

        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_execute($stmt);
            $fragranceArray = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS);
        }

        return $fragranceArray;
    }

    public function getSpecificFragrance($fragranceId, $option)
    {
        $fragranceArray = array();
        $specificFragranceCursor = oci_new_cursor($this->conn);
        $stmt = oci_parse($this->conn, 'begin :result := SPECIFICPERFUME(:id); end;');
        oci_bind_by_name($stmt, ':result', $specificFragranceCursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt, ':id', $fragranceId);
        oci_execute($stmt);
        oci_execute($specificFragranceCursor);

        while (($row = oci_fetch_array($specificFragranceCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceArray, $row);
        }

        if ($option === null)
        {
            $option = 1;
        }

        foreach ($fragranceArray[$option] as $key => $value)
        {
            $text = str_replace("\u0026amp;", "&", $value);
            $text = str_replace("\u0027", "'", $value);
            $fragranceArray[$option][$key] = $text;
        }

        $specificQuantityArray = $fragranceArray[$option];
        return $specificQuantityArray;
    }

    public function filterBy($brand, $note, $price, $occasion, $season, $gender)
    {

        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := lista_parfumuri_filtrare(:occasion, :brand, :note, :season, :price, :gender); end;')))
        {
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':occasion', $occasion);
            oci_bind_by_name($stmt, ':brand', $brand);
            oci_bind_by_name($stmt, ':note', $note);
            oci_bind_by_name($stmt, ':price', $price);
            oci_bind_by_name($stmt, ':season', $season);
            oci_bind_by_name($stmt, ':gender', $gender);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();

        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function checkStock($perfumeId, $quantity)
    {
        $stock = null;
        $sqlQuery = 'select stoc from PARFUMURI where id=' . $perfumeId . ' and cantitate=' . strval($quantity);
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Filtering failed";
        } else
        {
            oci_execute($stmt);
            $stock = oci_fetch_row($stmt);
        }
        $stockInt = intval($stock[0]);
        return $stockInt;
    }

    public function todaySpecialDiscounts(): array
    {
        //return the 10 today's special discounts
        //this will be modified randomly depending on the day
    }

    public function clearanceSales(): array
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := clearanceSales(); end;')))
        {
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function resemblingFragrances($fragranceId): array
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := resemblingFragrances(:p_id); end;')))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':p_id', $fragranceId);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function ourRecommendation(): array
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := ourRecommendation(); end;')))
        {
            http_response_code(500);
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function youMightLike($email): array
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := lista_parfumuri_preferinte(:email); end;')))
        {
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ':email', $email);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function newestReleases(): array
    {
        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := newestReleases(); end;')))
        {
            echo "Filtering failed";
        } else
        {
            oci_bind_by_name($stmt, ':result', $filteredCursor, -1, OCI_B_CURSOR);
            oci_execute($stmt);
            oci_execute($filteredCursor);
        }

        $fragranceList = array();
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
        }

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function getAllBrands()
    {
        $allBrands = oci_new_cursor($this->conn);
        $stmt = oci_parse($this->conn, 'begin :result := GETALLBRANDS; end;');
        oci_bind_by_name($stmt, ':result', $allBrands, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($allBrands);

        while (($row = oci_fetch_array($allBrands, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            $text = implode(" ", $row);
            $text = str_replace("\u0026amp;", "&", $text);
            $text = str_replace("\u0027", "'", $text);
            echo self::label . $text . self::checkBox . "value=\"" . $text . "\" id=\"brands\" name=\"brands[]\">" . self::span;
            echo "\n";
        }

        oci_free_cursor($allBrands);
        oci_free_statement($stmt);
        oci_close($this->conn);
    }

}