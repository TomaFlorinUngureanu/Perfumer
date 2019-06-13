<?php
error_reporting(0);
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/userRelated/GoogleLoginApi.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');
require_once('../../backend/controller/PerfumeController.php');

GoogleLoginApi::startSession();
$perfumerController = new PerfumeController();

$redirect = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
    '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
    '&access_type=online';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Promo</title>
    <style>
        <?php include '../styles/PerfumerPromoStyles.css'; ?>
    </style>
</head>
<body onload="getClearanceSales()">

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Promotions</h1>
</div>

<div class="topnav">
    <a href="PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.php">Promo</a>
    <a href="PerfumerFragrances.php">Fragrances</a>
    <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>

    <?php if (!isset($_SESSION["userName"])) : ?>
        <a href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= $redirect ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right" href="../../backend/utils/userRelated/Logout.php">Logout</a>
        <?php if ($_SESSION["userName"] == 'Admin') : ?>
            <a href="adminSide/AdminPage.php">Admin Page</a>
        <?php else : ?>
            <a href="PerfumerMyProfile.php">My Profile</a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!($_SESSION["userName"] == 'Admin')) : ?>
        <a href="PerfumerContact.php" style="float:right">Contact</a>
    <?php endif; ?>
</div>

<div class="row">
    <div class="rightcolumn">
        <div class="card">
            <h3>Clearance Sales</h3>
            <div class="clearanceSalesGrid" id="clearanceSalesGrid">

            </div>
            <script src="../../scripts/ajaxRelated.js"></script>
        </div>
    </div>

    <div class="footer">
        <h2>Contact and authors</h2>
    </div>

</body>

</html>