<?php
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');
require_once ('../../backend/database/DbConnection.php');
require_once('../../backend/controller/CommandController.php');
require_once ('../../backend/model/PerfumeModel.php');

GoogleLoginApi::startSession();
$userEmail = null;
$commandController = new CommandController();
if(isset($_SESSION["userEmail"]))
{
    $userEmail = $_SESSION["userEmail"];
}

GoogleLoginApi::startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Shopping Cart</title>
    <style>
        <?php include '../styles/PerfumerShoppingCartStyles.css'; ?>
    </style>
</head>

<body>

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Shopping cart</h1>
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
    <?= $redirect ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right" href="../../backend/utils/logout.php">Logout</a>
        <a href="PerfumerMyProfile.php">My Profile</a>
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
            <h3>Shopping Cart</h3>
            <div class="ShoppingCartWrapper">
                <?= $commandController->printShoppingCart($commandController->getShoppingCart($userEmail)) ?>
            </div>
            <script src="../scripts/fragranceQuantity.js"></script>
            <input type="button" class="button" value="Proceed to checkout">
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
    </div>
</div>

<div class="footer">
    <h2>Contact and authors</h2>
</div>

</body>

</html>