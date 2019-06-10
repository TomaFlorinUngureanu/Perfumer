<?php
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');
require_once('../../libs/PHPMailer_5.2.4/class.phpmailer.php');
require_once('../../backend/utils/MailFunctionality.php');

GoogleLoginApi::startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Contact</title>
    <style>
        <?php include '../styles/PerfumerContactStyles.css'; ?>
    </style>
</head>

<body>
<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>My Profile</h1>
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
    <a style="float:right" href="../../backend/utils/logout.php">Logout</a>
    <a href="PerfumerMyProfile.php">My Profile</a>
    <a href="PerfumerContact.php" style="float:right">Contact</a>
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Go!</button>
        </form>
    </div>
</div>
<div class="contactForm">
    <label for="name">Name:</label>
    <input>
    <label for="email">Email:</label>
    <input>
    <label for="occasions">Preferred occasions:</label>
    <input>
    <label for="notes">My favorite notes:</label>
    <input>
</div>
</body>
</html>
