<?php
require_once('../controller/PerfumeController.php');
require_once('../database/DbConnection.php');

$perfumeController = new PerfumeController();
$quantity = null;
$fragranceId = null;
$stock = null;
if (isset($_POST['fragranceId']) && isset($_POST['fragranceQuantity']))
{
    $quantity = json_decode($_POST["fragranceQuantity"])[0];
    $fragranceId = json_decode($_POST["fragranceId"])[0];
    $stock = $perfumeController->checkStock($fragranceId, $quantity);
}

echo $stock;