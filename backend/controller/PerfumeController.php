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


    public function printSpecificFragrance()
    {

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

//        printf("<br/>");
//        var_dump($fragranceList);

        oci_free_statement($stmt);
        oci_free_cursor($filteredCursor);
        return $fragranceList;
    }

    public function newestReleases(): array
    {
        //return 4 of the newest releases, 2 for each gender
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