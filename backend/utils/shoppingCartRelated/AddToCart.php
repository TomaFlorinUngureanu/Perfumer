<?php
error_reporting(0);
ob_start();
require_once('../userRelated/GoogleLoginApi.php');
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');
require_once('../../model/PerfumeModel.php');
require_once('../../controller/CommandController.php');
GoogleLoginApi::startSession();

if (!isset($_SESSION["userEmail"]) || sizeof($_SESSION["userEmail"]) == 0)
{
    echo "You must login first!";
} else
{
    if (isset($_POST["fragranceCartId"]) && isset($_POST["fragranceCartOption"]) &&
        isset($_POST["amountCart"]) && isset($_POST["costCart"]))
    {
        $fragranceId = json_decode($_POST["fragranceCartId"])[0];
        $fragranceOption = json_decode($_POST["fragranceCartOption"])[0];
        $fragranceAmount = json_decode($_POST["amountCart"])[0];
        $fragranceCost = json_decode($_POST["costCart"])[0];
        $userEmail = $_SESSION["userEmail"];

        $perfumeController = new PerfumeController();
        $specificFragrance = $perfumeController->getSpecificFragrance($fragranceId, $fragranceOption);

        $perfumeModel = new PerfumeModel();
        $perfumeModel->setModel($specificFragrance);
        //var_dump($perfumeModel);

        $commandController = new CommandController();
        var_dump($commandController->addToShoppingCart($perfumeModel, $fragranceCost, $fragranceAmount, $userEmail));

    }
}