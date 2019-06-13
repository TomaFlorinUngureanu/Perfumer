<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once('../../config/Settings.php');
require_once('../../backend/utils/userRelated/GoogleLoginApi.php');

GoogleLoginApi::startSession();
$userInfo = GoogleLoginApi::greeting();

if($userInfo['email'] == 'perfumer0noreply@gmail.com')
{
    $_SESSION["userName"] = 'Admin';
}
else
{
    $_SESSION["userName"] = $userInfo['name'];
}
$_SESSION["userEmail"] = $userInfo['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Auth</title>
    <style>
        <?php include '../styles/GAuthStyleSheet.css'; ?>
    </style>
</head>
<body onload="loadMultiple()">

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Welcome, <?=$_SESSION["userName"]?></h1>
</div>
<div class="topnav">
    <a href="PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.php">Promo</a>
    <a href="PerfumerFragrances.php">Fragrances</a>
    <?php if (!($_SESSION["userName"] == 'Admin')) : ?>
        <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>
    <?php endif; ?>

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
            <h3>You might like</h3>
            <div class="youMightLikeWrapper" id="youMightLikeWrapper">
                <div class="youMighLikeGrid" id="youMighLikeGrid">

                </div>
            </div>
        </div>
        <div class="card">
            <h3>Our recommandation</h3>
            <div class="ourRecommendationWrapper" id="ourRecommendationWrapper">
                <div class="ourRecommendationGrid" id="ourRecommendationGrid"></div>
            </div>
        </div>
    </div>
    <div class="leftcolumn">
        <div class="card">
            <div class="newestReleasesWrapper" id="newestReleasesGrid">
                <div class="newestReleasesGrid" id="newestReleasesGrid"></div>
            </div>
        </div>
        <script src="../../scripts/ajaxRelated.js"></script>
    </div>
</div>

<div class="footer">
    <h2>Contact and authors</h2>
    <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px"
                 src="http://jigsaw.w3.org/css-validator/images/vcss"
                 alt="Valid CSS!" />
        </a>
    </p>
</div>

</body>

</html>