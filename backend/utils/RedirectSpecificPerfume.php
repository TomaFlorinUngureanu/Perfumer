<?php
ob_start();
require_once ('../controller/PerfumeController.php');
require_once ('../utils/GoogleLoginApi.php');
require_once ('../database/DbConnection.php');
GoogleLoginApi::startSession();

$fragranceId = json_decode($_POST["fragranceId"]);
$fragranceQuantity = null;
var_dump($fragranceId);
$_SESSION["fragranceId"] = $fragranceId;
if(isset($_POST["fragranceOption"]))
{
    $fragranceQuantity = json_decode($_POST["fragranceOption"]);
    $_SESSION["fragranceOption"] = $fragranceQuantity;
}
else
{
    $_SESSION["fragranceOption"] = array();
}
