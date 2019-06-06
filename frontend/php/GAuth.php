<?php
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');

GoogleLoginApi::startSession();
$userInfo = GoogleLoginApi::greeting();
$_SESSION["userName"] = $userInfo['name'];
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
<body>

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="..\images\logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Welcome, <?= $_SESSION["userName"] ?></h1>
    <p>Develop your taste</p>
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
    <a style="float:right">Logout</a>
    <a href="PerfumerContact.php" style="float:right">Contact</a>
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="row">
    <div class="rightcolumn">
        <div class="card">
            <h2>Best sellers</h2>
            <div class="fakeimg" style="height:100px;">Slideshow of best sellers with their prices</div>
        </div>

        <div class="card">
            <h3>Our recommandation</h3>
            <div class="fakeimg">
                <p>Image with perfume #1 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #2 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #3 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with perfume #4 for men and women</p>
            </div>
        </div>

        <div class="card">
            <h3>Gift Sets</h3>
            <div class="fakeimg">
                <p>Image with gift set #1 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with gift set #2 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with gift set #3 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with gift set #4 for men and women</p>
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
    </div>
</div>
<div class="footer">
    <h2>Contact and authors</h2>
</div>

</body>

</html>