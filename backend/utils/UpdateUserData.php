<?php
ob_start();
require_once('../utils/GoogleLoginApi.php');
require_once('../database/DbConnection.php');
require_once ('../../backend/controller/UserDataController.php');
GoogleLoginApi::startSession();


if (!isset($_SESSION["userEmail"]) || sizeof($_SESSION["userEmail"]) == 0)
{
    echo "You must login first!";
} else
    if (isset($_POST['userEmail']) && isset($_POST['occasion']) &&
        isset($_POST['season']) && isset($_POST['deliveryAddress']) && isset($_POST['note']) &&
        sizeof($_POST['userEmail']) != 0 && sizeof($_POST['occasion']) != 0 &&
        sizeof($_POST['season']) != 0 && sizeof($_POST['deliveryAddress']) != 0)
    {
        $email = json_decode($_POST['userEmail']);
        $deliveryAddress = json_decode($_POST['deliveryAddress']);
        $note = null;
        if(sizeof($_POST['note']) !=0 )
        {
            $note = json_decode($_POST['note'])[0];
        }
        $occasion = json_decode($_POST['occasion'])[0];
        $season = json_decode($_POST['season'])[0];

        $userDataController = new UserDataController();
        echo $userDataController->updateUserData($email, $deliveryAddress, $occasion, $note, $season);
    }