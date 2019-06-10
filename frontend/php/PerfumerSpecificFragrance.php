<?php
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');
require_once('../../backend/controller/PerfumeController.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');

GoogleLoginApi::startSession();
$fragranceId = json_decode($_SESSION["fragranceId"][0]);
$fragranceOption = null;
if (isset($_SESSION["fragranceOption"]) && sizeof($_SESSION["fragranceOption"]) != 0)
{
    $fragranceOption = json_decode($_SESSION["fragranceOption"][0]); //0,1,2,3
}

$perfumeController = new PerfumeController();
$specificFragranceArray = $perfumeController->getSpecificFragrance($fragranceId, $fragranceOption);
$perfumeModel = new PerfumeModel();
$perfumeModel->setModel($specificFragranceArray);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Home</title>
    <style>
        <?php include '../styles/PerfumerSpecificFragranceStyles.css'; ?>
    </style>
</head>

<body>

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Le petit parfum</h1>
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
            <a href="#">Yves Saint-Laurent</a>
            <a href="#">Dolce & Gabanna</a>
        </div>
    </div>
    <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>

    <?php if (!isset($_SESSION["userName"])) : ?>
        <a id="LoginStatus" href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= $redirect ?>" style="float:right">Login</a>
    <?php else : ?>
        <a href="PerfumerMyProfile.php">My Profile</a>
        <a id="LoginStatus" style="float:right" href="../../backend/utils/logout.php">Logout</a>
    <?php endif; ?>

    <a href="PerfumerContact.php" style="float:right">Contact</a>
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Go!</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="rightcolumn">
        <div class="card">
            <div class="specificPerfumeWrapper">
                <div class="fragranceImageWrapper">
                    <img class="fragranceImage" src="<?= $perfumeModel->getPicture() ?>" alt="">
                </div>
                <div class="specificPerfumeTextWrapper">
                    <div class="specificPerfumeText">
                        <p class="fragranceTitle" id="fragranceTitle">Name: <?= $perfumeModel->getName() ?></p>
                        <p class="fragranceBrand" id="fragranceBrand">Brand: <?= $perfumeModel->getBrand() ?></p>
                        <p class="fragranceQuantity" id="fragranceQuantity">
                            Quantity: <?= $perfumeModel->getQuantity() ?>
                            ml</p>
                        <p class="fragrancePrice" id="fragrancePrice"><?= $perfumeModel->getPrice() ?> RON</p>
                        <p class="fragranceNotes" id="fragranceNotes">Notes: <?= $perfumeModel->getNotes() ?></p>
                        <p hidden class="fragranceId" id="fragranceId"><?= $perfumeModel->getPerfumeId() ?></p>
                        <p class="fragranceOccasion" id="fragranceOccasion">
                            Occasion: <?= $perfumeModel->getOccasion() ?></p>
                        <p class="fragranceSeason" id="fragranceSeason">
                            Season: <?= $perfumeModel->getSeason() ?></p>
                        <p class="fragranceLaunchDate" id="fragranceLaunchDate">
                            Launch date: <?= $perfumeModel->getReleaseDate() ?></p>
                    </div>
                </div>
            </div>
            <div class="changeQuantityWrapper">
                <button type="button" class="ml50Button" id="0" onclick="desiredQuantity(this.id)">50 ml</button>
                <button type="button" class="ml100Button" id="1" onclick="desiredQuantity(this.id)">100 ml</button>
                <button type="button" class="ml150Button" id="2" onclick="desiredQuantity(this.id)">150 ml</button>
                <button type="button" class="ml200Button" id="3" onclick="desiredQuantity(this.id)">200 ml</button>
            </div>
            <div class="purchaseWrapper">
                <div class="quantityWrapper">
                    <button type="button" class="minusButton" onclick="decrementValue()">-</button>
                    <input type="text" class="quantity-amount" id="quantity-amount" value="1" readonly/>
                    <button type="button" class="plusButton" onclick="incrementValue()">+</button>
                </div>
                <div class="toCartWrapper">
                    <button type="button" class="toCartButton" onclick="addToCart()">Add to cart</button>
                </div>
            </div>
            <script src="../scripts/fragranceQuantity.js?v=2"></script>
            <script src="../scripts/ajaxRelated.js?v=2">checkStock()</script>
            <div class="resemblingFragrancesWrapper">
            </div>
        </div>
    </div>
    <div class="leftcolumn">
        <div class="card">
            <h2>Newest releases</h2>
            <h5>On the DD/MM/YYYY the X brand released a new frangrance with name Z</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Notes of the fragrance</p>
            <p>Some description of the fragrance.</p>
        </div>
        <div class="card">
            <h2>Newest releases</h2>
            <h5>On the DD/MM/YYYY the X brand released a new frangrance with name Z</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Notes of the fragrance</p>
            <p>Some description of the fragrance.</p>
        </div>
    </div>
</div>

<div class="footer">
    <h2>Contact and authors</h2>
</div>

</body>

</html>