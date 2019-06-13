<?php
error_reporting(0);
function setFilters(&$postedBrands, &$postedBrandsFlag, &$postedBrandsArray, &$postedNotes, &$postedNotesFlag,
                    &$postedNotesArray, &$postedOccasions, &$postedOccasionsFlag, &$postedOccasionsArray,
                    &$postedSeasons, &$postedPrice, &$postedGender)
{

    if (isset($_POST['brands']) && sizeof(json_decode($_POST['brands'])) != 0)
    {
        if (implode(" ", json_decode($_POST['brands'])) != json_decode($_POST['brands'])[0])
        {
            $postedBrands = json_decode($_POST['brands'])[0];
            $postedBrandsFlag = true;
            $postedBrandsArray = json_decode($_POST['brands']);
        } else
        {
            $postedBrands = implode(" ", json_decode($_POST['brands']));
        }
    }

    if (isset($_POST['notes']) && sizeof(json_decode($_POST['notes'])) != 0)
    {
        if (implode(" ", json_decode($_POST['notes'])) != json_decode($_POST['notes'])[0])
        {
            $postedNotes = json_decode($_POST['notes'])[0];
            $postedNotesFlag = true;
            $postedNotesArray = json_decode($_POST['notes']);
        } else
        {
            $postedNotes = implode(" ", json_decode($_POST['notes']));
        }
    }

    if (isset($_POST['occasions']) && sizeof(json_decode($_POST['occasions'])) != 0)
    {
        if (implode(" ", json_decode($_POST['occasions'])) != json_decode($_POST['occasions'])[0])
        {
            $postedOccasions = json_decode($_POST['occasions'])[0];
            $postedOccasionsFlag = true;
            $postedOccasionsArray = json_decode($_POST['occasions']);
        } else
        {
            $postedOccasions = implode(" ", json_decode($_POST['occasions']));
        }
    }

    if (isset($_POST['seasons']) && sizeof(json_decode($_POST['seasons'])) != 0)
    {
        $postedSeasons = implode(" ", json_decode($_POST['seasons']));
    }

    if (isset($_POST['myRange']) && sizeof(json_decode($_POST['myRange'])) != 0)
    {
        $convertedPrice = json_decode($_POST['myRange']);
        if (is_numeric($convertedPrice[0]))
        {
            $postedPrice = intval($convertedPrice[0]);
        }
    }

    if (isset($_POST['genders']) && sizeof(json_decode($_POST['genders'])) != 0)
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
    //var_dump($postedNotesArray);
    foreach ($fragranceList as $row)
    {
        $forFlag = false;
        $returnedNotes = $row['NOTE'];

        if ($postedNotesFlag == true)
        {
            foreach ($postedNotesArray as $item)
            {
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