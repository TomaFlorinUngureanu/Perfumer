<?php

function setFilters(&$postedBrands, &$postedBrandsFlag, &$postedBrandsArray, &$postedNotes, &$postedNotesFlag,
                    &$postedNotesArray, &$postedOccasions, &$postedOccasionsFlag, &$postedOccasionsArray,
                    &$postedSeasons, &$postedPrice, &$postedGender)
{
//    printf("<br/>");
//    printf("brands:");
//    var_dump(json_decode($_POST['brands']));
    if (isset($_POST['brands']))
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
    if (isset($_POST['notes']))
    {
        if (implode(" ", json_decode($_POST['notes'])) != json_decode($_POST['notes'])[0])
        {
            var_dump("Array");
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
    if (isset($_POST['occasions']))
    {
        if (implode(" ", json_decode($_POST['occasions'])) != json_decode($_POST['occasions'])[0])
        {
            var_dump("Array");
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
    if (isset($_POST['seasons']))
    {
        $postedSeasons = implode(" ", json_decode($_POST['seasons']));
    }

//    printf("<br/>");
//    printf("myRange:");
    $convertedPrice = json_decode($_POST['myRange']);
    if (isset($_POST['myRange']))
    {
        if (is_numeric($convertedPrice[0]))
        {
            $postedPrice = intval($convertedPrice[0]);
        }
    }

//    printf("<br/>");
//    printf("genders:");
//    var_dump(json_decode($_POST['genders']));
    if (isset($_POST['genders']))
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