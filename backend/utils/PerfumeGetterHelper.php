<?php

function setFilters(&$postedBrands, &$postedBrandsFlag, &$postedBrandsArray, &$postedNotes, &$postedNotesFlag,
                    &$postedNotesArray, &$postedOccasions, &$postedOccasionsFlag, &$postedOccasionsArray,
                    &$postedSeasons, &$postedPrice, &$postedGender)
{
//    printf("<br/>");
//    printf("brands:");
//    var_dump(json_decode($_POST['brands']));
<<<<<<< HEAD
    if (isset($_POST['brands']) && sizeof(json_decode($_POST['brands'])) != 0)
=======
    if (isset($_POST['brands']))
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
    {
        if (implode(" ", json_decode($_POST['brands'])) != json_decode($_POST['brands'])[0])
        {
            //var_dump("Array");
            $postedBrands = json_decode($_POST['brands'])[0];
            $postedBrandsFlag = true;
            $postedBrandsArray = json_decode($_POST['brands']);
        } else
        {
            $postedBrands = implode(" ", json_decode($_POST['brands']));
        }
    }

//    printf("<br/>");
//    printf("notes:");
//    var_dump(json_decode($_POST['notes']));
<<<<<<< HEAD
    if (isset($_POST['notes']) && sizeof(json_decode($_POST['notes'])) != 0)
    {
        if (implode(" ", json_decode($_POST['notes'])) != json_decode($_POST['notes'])[0])
        {
//            var_dump("Array");
=======
    if (isset($_POST['notes']))
    {
        if (implode(" ", json_decode($_POST['notes'])) != json_decode($_POST['notes'])[0])
        {
            var_dump("Array");
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
            $postedNotes = json_decode($_POST['notes'])[0];
            $postedNotesFlag = true;
            $postedNotesArray = json_decode($_POST['notes']);
        } else
        {
            $postedNotes = implode(" ", json_decode($_POST['notes']));
        }
    }

//    printf("<br/>");
//    printf("occasions:");
//    var_dump(json_decode($_POST['occasions']));
<<<<<<< HEAD
    if (isset($_POST['occasions']) && sizeof(json_decode($_POST['occasions'])) != 0)
    {
        if (implode(" ", json_decode($_POST['occasions'])) != json_decode($_POST['occasions'])[0])
        {
//            var_dump("Array");
=======
    if (isset($_POST['occasions']))
    {
        if (implode(" ", json_decode($_POST['occasions'])) != json_decode($_POST['occasions'])[0])
        {
            var_dump("Array");
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
            $postedOccasions = json_decode($_POST['occasions'])[0];
            $postedOccasionsFlag = true;
            $postedOccasionsArray = json_decode($_POST['occasions']);
        } else
        {
            $postedOccasions = implode(" ", json_decode($_POST['occasions']));
        }
    }

//    printf("<br/>");
//    printf("seasons:");
//    var_dump(json_decode($_POST['seasons']));
<<<<<<< HEAD
    if (isset($_POST['seasons']) && sizeof(json_decode($_POST['seasons'])) != 0)
=======
    if (isset($_POST['seasons']))
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
    {
        $postedSeasons = implode(" ", json_decode($_POST['seasons']));
    }

//    printf("<br/>");
//    printf("myRange:");
<<<<<<< HEAD
    if (isset($_POST['myRange']) && sizeof(json_decode($_POST['myRange'])) != 0)
    {
        $convertedPrice = json_decode($_POST['myRange']);
=======
    $convertedPrice = json_decode($_POST['myRange']);
    if (isset($_POST['myRange']))
    {
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
        if (is_numeric($convertedPrice[0]))
        {
            $postedPrice = intval($convertedPrice[0]);
        }
    }

//    printf("<br/>");
//    printf("genders:");
//    var_dump(json_decode($_POST['genders']));
<<<<<<< HEAD
    if (isset($_POST['genders']) && sizeof(json_decode($_POST['genders'])) != 0)
=======
    if (isset($_POST['genders']))
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
    {
        switch (json_decode($_POST['genders'])[0])
        {
            case "male":
                {
                    $postedGender = 1;
                    break;
                }
            case "female":
                {
                    $postedGender = 2;
                    break;
                }

            case "unisex":
                {
                    $postedGender = 3;
                    break;
                }
        }
    }
}

function perfumeGetterHelper($fragranceList, $postedNotesFlag, $postedNotesArray, &$fragranceArray, &$forFlag)
{
    foreach ($fragranceList as $row)
    {
        $forFlag = false;
        $returnedNotes = $row['NOTE'];

        if ($postedNotesFlag == true)
        {
            foreach ($postedNotesArray as $item)
            {
                //var_dump($item);
                if (strpos($returnedNotes, $item) == false)
                {
                    $forFlag = true;
                    break;
                }
            }

            if ($forFlag)
            {
                continue;
            }
        }
        array_push($fragranceArray, $row);
    }
}