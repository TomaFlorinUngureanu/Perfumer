<?php
ob_start();
include ('../../config/emailConfig.ini');
require_once('Settings.php');
require_once('utils/GoogleLoginApi.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');
require_once('../../backend/controller/PerfumeController.php');

GoogleLoginApi::startSession();
$perfumerController = new PerfumeController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Promo</title>
    <style>
        <?php include '../styles/PerfumerPromo.css'; ?>
    </style>
</head>
<body>

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
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="leftcolumn" style="padding-bottom: 35px">
        <div class="card">
            <h2>Filters</h2>
            <h3>Price range:</h3>
            <div class="slidecontainer">
                <input type="range" min="100" max="1000" value="100" class="slider" id="myRange">
                <p>Max value: <span id="demo"></span></p>
                <script src="../scripts/fragranceSliders.js">
                </script>
            </div>
            <h3>For who?</h3>
            <label class="container">Her
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container">Him
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container">Unisex
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <h3>Season</h3>
            <div class="fragranceSeason">
                <?php foreach (PerfumeModel::seasons as $season): ?>
                    <label class="container"><?= $season ?>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <h3>Occasion</h3>
            <div class="fragranceOccasions">
                <?php foreach (PerfumeModel::occasions as $occasion): ?>
                    <label class="container"><?= $occasion ?>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <h3>Brands</h3>
            <div class="fragranceBrands">
                <?php $perfumerController->getAllBrands(); ?>
            </div>
            <h3>Notes</h3>
            <div class="fragranceNotes">
                <?php foreach (PerfumeModel::notes as $note): ?>
                    <label class="container"><?= $note ?>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="rightcolumn">
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
        <div class="card">
            <h3>Clearance sales</h3>
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