<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
require_once('../../database/DbConnection.php');
require_once ('../../controller/CommandController.php');
require_once ('../../utils/userRelated/GoogleLoginApi.php');
GoogleLoginApi::startSession();

if(isset($_SESSION['userEmail']) && sizeof($_SESSION['userEmail']) != 0)
{
    $email = $_SESSION['userEmail'];
    $commandController = new CommandController();
    $response = $commandController->sendCommand($email);
    echo $response;
}