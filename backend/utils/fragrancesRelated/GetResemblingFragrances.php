<?php
ob_start();
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');

if(isset($_POST['fragranceId']) && sizeof($_POST['fragranceId']) != 0)
{
    $fragranceId = json_decode($_POST['fragranceId'])[0];
    $perfumeController = new PerfumeController();
    $fragranceArray = $perfumeController->resemblingFragrances($fragranceId);
    echo(json_encode($fragranceArray));
    return (json_encode($fragranceArray));
}