<?php
ob_start();
require_once ('../database/DbConnection.php');
require_once ('../controller/PerfumeController.php');
require_once('../../backend/utils/GoogleLoginApi.php');
GoogleLoginApi::startSession();

if (isset($_SESSION["userEmail"]))
{
    $email = $_SESSION["userEmail"];
    $perfumerController = new PerfumeController();
    $fragranceArray = $perfumerController->youMightLike($email);
    echo (json_encode($fragranceArray));
    return (json_encode($fragranceArray));
}
