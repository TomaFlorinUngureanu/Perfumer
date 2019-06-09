<?php
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
<<<<<<< HEAD
=======

    public function getMinMaxPriceSliders($order): int
    {
        $sqlQuery = 'select * from (select TO_NUMBER(pret) from parfumuri group by TO_NUMBER(pret) 
                    order by TO_NUMBER(pret) ' . $order . ') where rownum=1';
        $maxPrice = null;
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Filtering failed";
        } else
        {
            oci_execute($stmt);
            $maxPrice = implode(" ",oci_fetch_row($stmt));
        }

        $maxPrice = intval($maxPrice);

        return $maxPrice;
    }

>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733

    public function getMinMaxPriceSliders($order): int
    {
        $sqlQuery = 'select * from (select TO_NUMBER(pret) from parfumuri group by TO_NUMBER(pret) 
                    order by TO_NUMBER(pret) ' . $order . ') where rownum=1';
        $price = null;
        if (!($stmt = oci_parse($this->conn, $sqlQuery)))
        {
            echo "Filtering failed";
        } else
        {
            oci_execute($stmt);
            $price = implode(" ", oci_fetch_row($stmt));
        }

        $price = intval($price);

        return $price;
    }

<<<<<<< HEAD
    public function getSpecificFragrance($fragranceId, $option)
    {
        var_dump($fragranceId);
        var_dump($option);
        $fragranceArray = array();
        $specificFragranceCursor = oci_new_cursor($this->conn);
        $stmt = oci_parse($this->conn, 'begin :result := SPECIFICPERFUME(:id); end;');
        oci_bind_by_name($stmt, ':result', $specificFragranceCursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($stmt,':id',$fragranceId);
        oci_execute($stmt);
        oci_execute($specificFragranceCursor);

        while (($row = oci_fetch_array($specificFragranceCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
=======
    public function filterBy($brand, $note, $price, $occasion, $season, $gender)
    {
//        printf("<br/>");
//        printf($brand);
//        printf("<br/>");
//        printf($note);
//        printf("<br/>");
//        printf($price);
//        printf("<br/>");
//        printf($occasion);
//        printf("<br/>");
//        printf($season);
//        printf("<br/>");
//        printf($gender);
//        printf("<br/>");

        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := lista_parfumuri_filtrare(:occasion, :brand, :note, :season, :price, :gender); end;')))
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
        {
            array_push($fragranceArray, $row);
        }

        if($option === null)
        {
            $option = 1;
        }
        $specificQuantityArray =  $fragranceArray[$option];
        return $specificQuantityArray;
    }

    public function filterBy($brand, $note, $price, $occasion, $season, $gender)
    {
//        printf("<br/>");
//        printf($brand);
//        printf("<br/>");
//        printf($note);
//        printf("<br/>");
//        printf($price);
//        printf("<br/>");
//        printf($occasion);
//        printf("<br/>");
//        printf($season);
//        printf("<br/>");
//        printf($gender);
//        printf("<br/>");

        $filteredCursor = oci_new_cursor($this->conn);
        if (!($stmt = oci_parse($this->conn,
            'begin :result := lista_parfumuri_filtrare(:occasion, :brand, :note, :season, :price, :gender); end;')))
        {
            var_dump("HERE");
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
<<<<<<< HEAD
        //var_dump("Starting");

        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
          //  var_dump($row);
            array_push($fragranceList, $row);
        }
        //var_dump("Ending");
        //printf("<br/>");
        //var_dump($fragranceList);

        for ($i = 0; $i < sizeof($fragranceList); $i++)
        {
            //var_dump($fragranceList[$i]['POZA']);
            foreach ($fragranceList[$i] as $key => $value)
            {
                $text = str_replace("\u0026amp;", "&", $value);
                $text = str_replace("\u0027", "'", $value);
                $fragranceList[$i][$key] = $text;
            }
            //var_dump($fragranceList[$i]['POZA']);
        }

        //printf("<br/>");
        //var_dump($fragranceList);
=======
        while (($row = oci_fetch_array($filteredCursor, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            array_push($fragranceList, $row);
        }

//        printf("<br/>");
//        var_dump($fragranceList);
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function newestReleases(): array
    {
        //return 4 of the newest releases, 2 for each gender
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
        //returns randomly 10 of the fragrances that have < 10 quantity on stock
    }

    public function resemblingFragrances(): array
    {
        //on the same page with the single chosen fragraces
        //there will be 3-5 perfumes with resembling notes or brands chosen randomly
    }

    public function ourRecommendation(): array
    {
        //returns randomly 8 of the most sold fragrances, 2 for each gender
        // just the 100ml version
    }

    public function seasonalSales()
    {
        //this will redirect the users to a special page, designed for each season
        //the user will be able to select from 20 seasonal fragrances, 10 for men, 10 for women
        //of course, with discounts
    }

    public function search($criteria)
    {
        //criteria can be a string
        //1. tokenize the string
        //search the database for each field that matches each token and return 20 random entries from the results
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