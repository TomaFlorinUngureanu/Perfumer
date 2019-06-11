<?php
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');
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
        <a style="float:right" href="../../backend/utils/Logout.php">Logout</a>
        <a href="PerfumerMyProfile.php">My Profile</a>
    <?php endif; ?>

    <a href="PerfumerContact.php" style="float:right">Contact</a>
</div>

<div class="row">
    <div class="rightcolumn">
        <div class="card">
            <h3>Clearance Sales</h3>
            <div class="clearanceSalesGrid" id="clearanceSalesGrid">

            </div>
            <script src="../scripts/ajaxRelated.js"></script>
        </div>
        <div class="card">
            <h3>Special discounts</h3>
            <div class="fakeimg">
                <p>Image with perfume #1 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #2 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #3 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #4 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #5 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #6 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #7 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #8 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #9 + price, size in ml</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #10 + price, size in ml</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>Contact and authors</h2>
    </div>

</body>

</html>