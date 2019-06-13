<?php
ob_start();
require_once('../userRelated/GoogleLoginApi.php');
require_once('../../controller/ReportController.php');
require_once('../../database/DbConnection.php');


if (isset($_POST['note']) &&
    isset($_POST['season']) &&
    isset($_POST['occasion']) &&
    isset($_POST['byStock']) &&
    isset($_POST['userEmail']) &&
    isset($_POST['date1']) &&
    isset($_POST['date2']))
{
    $note = json_decode($_POST['note'])[0];
    $season = json_decode($_POST['season'])[0];
    $occasion = json_decode($_POST['occasion'])[0];
    $byStock = intval(json_decode($_POST['byStock'])[0]);
    $userEmail = json_decode($_POST['userEmail'])[0];
    $date1 = json_decode($_POST['date1'])[0];
    $date2 = json_decode($_POST['date2'])[0];
    $limit = json_decode($_POST['rowLimit'])[0];

    if ($note === null)
    {
       $note = '';
    }
    if($season === null)
    {
        $season = '';
    }
    if($occasion === null)
    {
        $occasion = '';
    }

    $reportController = new ReportController();
    $response = $reportController->htmlReport($userEmail, $byStock, $note, $occasion, $season, $date1, $date2, $limit);
    echo $response;
    return $response;
}