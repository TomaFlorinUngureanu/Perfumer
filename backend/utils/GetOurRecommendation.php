<?php
ob_start();
require_once ('../database/DbConnection.php');
require_once ('../controller/PerfumeController.php');

$perfumeController = new PerfumeController();
$fragranceArray = $perfumeController->ourRecommendation();
echo(json_encode($fragranceArray));
return (json_encode($fragranceArray));
