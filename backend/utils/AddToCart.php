<?php
ob_start();
require_once ('../utils/GoogleLoginApi.php');
require_once ('../database/DbConnection.php');
require_once ('../controller/PerfumeController.php');
require_once ('../model/PerfumeModel.php');

GoogleLoginApi::startSession();
if(!isset($_SESSION["userEmail"]) || sizeof($_SESSION["userEmail"]) == 0)
{
    echo "You must login first!";
}
else
{
    if(isset($_POST["fragranceId"]) && isset($_POST["fragranceOption"]) &&
       isset($_POST["amount"]) && isset($_POST["cost"]))
    {
        $fragranceId = json_decode($_POST["fragranceId"]);
        $fragranceOption = json_decode($_POST["fragranceOption"]);
        $fragranceAmount = json_decode($_POST["amount"]);
        $fragranceCost = json_decode($_POST["cost"]);

        $perfumeController = new PerfumeController();
        $specificFragrance = $perfumeController->getSpecificFragrance($fragranceId, $fragranceOption);

        $perfumeModel = new PerfumeModel();
        $perfumeModel->setModel($specificFragrance);

        $commandController = new CommandController();
        $commandController->addToShoppingCart($perfumeModel, $fragranceCost, $fragranceAmount);
    }
}