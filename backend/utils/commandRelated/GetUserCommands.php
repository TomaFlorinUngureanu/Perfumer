<?php
ob_start();
require_once('../../database/DbConnection.php');
require_once ('../../controller/UserDataController.php');

if(isset($_POST['userEmail']) && sizeof($_POST['userEmail']) != 0)
{
    $email = json_decode($_POST['userEmail'])[0];
    $userDataController = new UserDataController();
    $userCommands = $userDataController->getUserCommands($email);
    echo(json_encode($userCommands));
    return (json_encode($userCommands));
}