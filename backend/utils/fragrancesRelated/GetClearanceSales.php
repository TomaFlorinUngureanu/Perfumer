<?php
error_reporting(0);
ob_start();
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');

$perfumeController = new PerfumeController();
$fragranceArray = $perfumeController->clearanceSales();
echo(json_encode($fragranceArray));
return (json_encode($fragranceArray));