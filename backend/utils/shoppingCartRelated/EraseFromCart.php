<?php
error_reporting(0);
ob_start();
require_once('../userRelated/GoogleLoginApi.php');
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');
require_once('../../model/PerfumeModel.php');
require_once('../../controller/CommandController.php');
GoogleLoginApi::startSession();

if(!isset($_SESSION["userEmail"]) || sizeof($_SESSION["userEmail"]) == 0)
{
    echo "You must login first!";
}
else
{
   if(isset($_POST['fragranceId']) && isset($_POST['fragranceCommandId']) &&
      isset($_POST['fragranceQuantity']) && isset($_POST['costCart']) &&
       sizeof($_POST['fragranceId']) != 0 && sizeof($_POST['fragranceQuantity']) != 0 &&
       sizeof($_POST['fragranceCommandId']) != 0 && sizeof($_POST['costCart']) != 0)
   {
       $fragranceId = json_decode($_POST['fragranceId'])[0];
       $commandId = json_decode($_POST['fragranceCommandId'])[0];
       $fragranceQuantity = json_decode($_POST['fragranceQuantity'])[0];
       $cost = json_decode($_POST['costCart'])[0];

       var_dump($fragranceId);
       var_dump($commandId);
       var_dump($fragranceQuantity);
       var_dump($cost);
       var_dump( $_SESSION["userEmail"]);

       $commandController = new CommandController();
       var_dump($commandController->eraseFromShoppingCart($fragranceId, $commandId,
           $fragranceQuantity, $cost, $_SESSION["userEmail"]));
   }
}