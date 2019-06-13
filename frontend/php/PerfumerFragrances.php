<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once('../../config/Settings.php');
require_once('../../backend/utils/userRelated/GoogleLoginApi.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');
require_once('../../backend/controller/PerfumeController.php');

GoogleLoginApi::startSession();
$perfumerController = new PerfumeController();
$minVal = $perfumerController->getMinMaxPriceSliders("asc");
$maxVal = $perfumerController->getMinMaxPriceSliders("desc");
$_POST = array();

$redirect = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
    '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
    '&access_type=online';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Fragrances</title>
    <style>
        <?php include '../styles/PerfumerFragrancesStyles.css'; ?>
    </style>
</head>

<body onload="getOurRecommendation()">

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Our collection of fragrances</h1>
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
    <div class="leftcolumn" style="padding-bottom: 35px">
        <div class="card">
            <p id="demo123" style="font-size: x-small"></p>
            <div class="filterH2">
                <input type="submit" onclick="loadXMLDoc()" value="Filter!">
                <script src="../../scripts/ajaxRelated.js?v=2"></script>
            </div>
            <br>
            <div class="search-container">
                <input type="text" placeholder="Search.." name="search" id="byNameSearch" class="byNameSearch">
                <button type="submit" onclick="getFragrancesByName()">Submit</button>
            </div>
            <br><br>
            <h3>Price range:</h3>
            <div class="slidecontainer">
                <input type="range" min="<?= $minVal ?>" max="<?= $maxVal ?>"
                       value="<?= $minVal ?>" class="slider" id="myRange" name="price[]">
                <p>Max price: <span id="demo"></span> RON</p>
                <script src="../../scripts/fragranceSliders.js">
                </script>
            </div>
            <h3>For who?</h3>
            <label class="radioContainer">Male
                <input type="radio" checked="checked" name="genders[]" id="genders" value="male">
                <span class="radioCheckmark"></span>
            </label>
            <label class="radioContainer">Female
                <input type="radio" checked="checked" name="genders[]" id="genders" value="female">
                <span class="radioCheckmark"></span>
            </label>
            <label class="radioContainer">Unisex
                <input type="radio" checked="checked" name="genders[]" id="genders" value="unisex">
                <span class="radioCheckmark"></span>
            </label>
            <h3>Season</h3>
            <div class="fragranceSeason">
                <?php foreach (PerfumeModel::seasons as $season): ?>
                    <label class="radioContainer"><?= $season ?>
                        <input type="radio" checked="checked" value="<?= $season ?>" id="seasons" name="seasons[]">
                        <span class="radioCheckmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <h3>Occasion</h3>
            <div class="fragranceOccasions">
                <?php foreach (PerfumeModel::occasions as $occasion): ?>
                    <label class="radioContainer"><?= $occasion ?>
                        <input type="radio" checked="checked" value="<?= $occasion ?>" id="occasions"
                               name="occasions[]">
                        <span class="radioCheckmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <h3>Brands</h3>
            <div class="fragranceBrands">
                <?php $perfumerController->getAllBrands(); ?>
            </div>
            <h3>Notes</h3>
            <div class="fragranceNotes" id="fragranceNotes">
                <?php foreach (PerfumeModel::notes as $note): ?>
                    <label class="container"><?= $note ?>
                        <input type="checkbox" value="<?= $note ?>" id="notes" name="notes[]">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <script src="../../scripts/limitCheckBoxSelection.js"></script>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <div class="fragranceNotToDelete" id="fragranceNotToDelete">
                <div class="fragranceGridWrapper" id="fragranceGridWrapper">
                </div>
                <h3 id="ourRecommendation">Our Recommendation</h3>
                <div class="ourRecommendationWrapper" id="ourRecommendationWrapper">
                    <div class="ourRecommendationGrid" id="ourRecommendationGrid"></div>
                </div>
                <div class="searchByNameWrapper" id="searchByNameWrapper">
                    <div class="searchByNameGrid" id="searchByNameGrid">
                    </div>
                </div>
            </div>
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