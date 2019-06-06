<?php
require_once('../controller/PerfumeController.php');
require_once('../database/DbConnection.php');
require_once('PerfumeGetterHelper.php');

function PerfumeGetter()
{
    $postedBrands = null;
    $postedOccasions = null;
    $postedSeasons = null;
    $postedNotes = null;
    $postedPrice = null;
    $postedGender = null;

    $postedOccasionsFlag = false;
    $postedBrandsFlag = false;
    $postedNotesFlag = false;
    $forFlag = false;

    $postedOccasionsArray = array();
    $postedNotesArray = array();
    $postedBrandsArray = array();

    setFilters($postedBrands, $postedBrandsFlag, $postedBrandsArray, $postedNotes, $postedNotesFlag,
        $postedNotesArray, $postedOccasions, $postedOccasionsFlag, $postedOccasionsArray,
        $postedSeasons, $postedPrice, $postedGender);

    $perfumeController = new PerfumeController();
    $fragranceArray = array();

    if ($postedBrandsFlag)
    {
        foreach ($postedBrandsArray as $brand)
        {
            $fragranceList = $perfumeController->filterBy($brand, $postedNotes, $postedPrice,
                $postedOccasions, $postedSeasons, $postedGender);

            perfumeGetterHelper($fragranceList, $postedNotesFlag, $postedNotesArray, $fragranceArray, $forFlag);
        }
    } else
    {
        $fragranceList = $perfumeController->filterBy($postedBrands, $postedNotes, $postedPrice,
            $postedOccasions, $postedSeasons, $postedGender);

        perfumeGetterHelper($fragranceList, $postedNotesFlag, $postedNotesArray, $fragranceArray, $forFlag);
    }

    $sold = array();
    foreach ($fragranceArray as $key => $row)
    {
        $sold[$key] = $row['UNITATIVANDUTE'];
    }

    array_multisort($sold, SORT_DESC, $fragranceArray);
   // printf(sizeof($fragranceArray));
   // printf("<br/>");
    echo (json_encode($fragranceArray));
}

PerfumeGetter();






