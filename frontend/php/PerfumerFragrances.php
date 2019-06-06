<?php
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');
require_once('../../backend/controller/PerfumeController.php');

GoogleLoginApi::startSession();
$perfumerController = new PerfumeController();
$minVal = $perfumerController->getMinMaxPriceSliders("asc");
$maxVal = $perfumerController->getMinMaxPriceSliders("desc");
$_POST = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Fragrances</title>
    <style>
        <?php include '../styles/PerfumerFragrancesStyles.css'; ?>
    </style>
</head>

<body>

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
    <div class="dropdown">
        <button class="dropbtn">Brands
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#">Lancome</a>
            <a href="#">Paco Rabanne</a>
            <a href="#">Hugo Boss</a>
            <a href="#">Versace</a>
            <a href="#">Armani</a>
            <a href="#">Calvin Klein</a>
            <a href="#">Chanel</a>
        </div>
    </div>
    <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>

    <?php if (!isset($_SESSION["userName"])) : ?>
        <a href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
        '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
        '&access_type=online' ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right">Logout</a>
    <?php endif; ?>

    <a href="PerfumerContact.php" style="float:right">Contact</a>
    <div class="search-container">
        <form action="SearchAction.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="leftcolumn" style="padding-bottom: 35px">
        <div class="card">
            <p id="demo123" style="font-size: x-small"></p>
            <div class="filterH2">
                <input type="submit" onclick="loadXMLDoc()" value="Filter!">
                <script src="../scripts/filterBy.js"></script>
            </div>
            <h3>Price range:</h3>
            <div class="slidecontainer">
                <input type="range" min="<?= $minVal ?>" max="<?= $maxVal ?>"
                       value="<?= $minVal ?>" class="slider" id="myRange" name="myRange">
                <p>Max price: <span id="demo"></span> RON</p>
                <script src="../scripts/fragranceSliders.js">
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
                    <label class="container"><?= $occasion ?>
                        <input type="checkbox" value="<?= $occasion ?>" id="occasions" name="occasions[]">
                        <span class="checkmark"></span>
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
            <script src="../scripts/limitCheckBoxSelection.js"></script>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <div class="fragranceGridWrapper" id="fragranceGridWrapper">
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>Contact and authors</h2>
    </div>

</body>

</html>