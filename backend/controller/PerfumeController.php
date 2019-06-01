<?php
header("Content-Type: text/html; charset=utf-8");
ini_set("default_charset", 'utf-8');


class PerfumeController
{
    private const label = "<label class=\"container\">";
    private const checkBox = "<input type=\"checkbox\"><span class=\"checkmark\"></span></label>";

    public function printSpecificFragrance()
    {

    }

    public function filterBy($perfumeName, $perfumeBrand, $notes, $releaseDate, $price, $gender): array
    {
        //prepared statement to filter by the given criteria
        //there will be a function called in order to do that
        if (!($stmt = oci_parse(DbConnection::getDbConnection(), "")))
        {
            echo "Filtering failed";
        }
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
        $allNotes = oci_new_cursor(DbConnection::getDbConnection());
        $stid = oci_parse(DbConnection::getDbConnection(), 'begin :result := GETALLNOTES; end;');
        oci_bind_by_name($stid, ':result', $allNotes, -1, OCI_B_CURSOR);

        oci_execute($stid);
        oci_execute($allNotes);

        while (($row = oci_fetch_array($allNotes, OCI_ASSOC + OCI_RETURN_NULLS)) != false)
        {
            $text = implode(" ", $row);
            $text = str_replace("\u0026amp;", "&", $text);
            $text = str_replace("\u0027", "'", $text);
            echo self::label . $text . self::checkBox;
            echo "\n";
        }
    }

}