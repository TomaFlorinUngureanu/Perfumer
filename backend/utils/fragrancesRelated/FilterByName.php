<?php
ob_start();
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');

if(isset($_POST['fragranceName']) && sizeof($_POST['fragranceName']) != 0)
{
    $fragranceName = json_decode($_POST['fragranceName'])[0];
    $perfumeController = new PerfumeController();
    $fragranceArray = $perfumeController->getFragrancesByName($fragranceName);
    echo(json_encode($fragranceArray));
    return (json_encode($fragranceArray));
}