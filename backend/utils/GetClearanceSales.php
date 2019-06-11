<?php
ob_start();
require ('../controller/PerfumeController.php');
require ('../database/DbConnection.php');

$perfumeController = new PerfumeController();
$fragranceArray = $perfumeController->clearanceSales();
echo(json_encode($fragranceArray));
return (json_encode($fragranceArray));