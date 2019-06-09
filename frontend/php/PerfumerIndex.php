<?php
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/GoogleLoginApi.php');

GoogleLoginApi::startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Perfumer Home</title>
    <style>
        <?php include '../styles/PerfumerIndexStyles.css'; ?>
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
        <a href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
        '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
        '&access_type=online' ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right" href="../../backend/utils/logout.php">Logout</a>
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