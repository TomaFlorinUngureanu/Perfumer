<?php
error_reporting(0);
ob_start();
require_once('../../database/DbConnection.php');
require_once('../../controller/PerfumeController.php');
require_once('../../utils/userRelated/GoogleLoginApi.php');
GoogleLoginApi::startSession();

$fragranceId = json_decode($_POST["fragranceId"]);
$fragranceQuantity = null;
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
