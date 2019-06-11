<?php
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');

GoogleLoginApi::startSession();
$userInfo = GoogleLoginApi::greeting();
$_SESSION["userName"] = $userInfo['name'];
$_SESSION["userEmail"] = $userInfo['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Auth</title>
    <style>
        <?php include '../styles/GAuthStyles.css'; ?>
    </style>
</head>
<body onload="loadMultiple()">

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Welcome, <?= $userInfo['name']?> </h1>
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
            <h2>Best sellers</h2>
            <div class="recommendRow">
                <div class="recommendColumn" style="background-color:#aaa;">
                    <h2>Column 1</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#bbb;">
                    <h2>Column 2</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#ccc;">
                    <h2>Column 3</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#ddd;">
                    <h2>Column 4</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#eee;">
                    <h2>Column 5</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#fff;">
                    <h2>Column 6</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#eee;">
                    <h2>Column 7</h2>
                    <p>Some text..</p>
                </div>
                <div class="recommendColumn" style="background-color:#ccc;">
                    <h2>Column 8</h2>
                    <p>Some text..</p>
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
        <script src="../scripts/ajaxRelated.js"></script>
    </div>
</div>

<div class="footer">
    <h2>Contact and authors</h2>
</div>

</body>

</html>