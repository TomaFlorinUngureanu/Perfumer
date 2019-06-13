<?php
//error_reporting(0);
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/userRelated/GoogleLoginApi.php');
require_once('../../backend/database/DbConnection.php');
require_once('../../backend/model/PerfumeModel.php');
require_once('../../backend/controller/UserDataController.php');

GoogleLoginApi::startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>My Profile</title>
    <style>
        <?php include '../styles/PerfumerMyProfileStyles.css'; ?>
    </style>
</head>

<body onload="getUserCommnds()">
<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <?php if (isset($_SESSION["userName"])) : ?>
        <h1>My Profile</h1>
    <?php else : ?>
        <h1>Please login to view this content</h1>
    <?php endif; ?>

</div>
<div class="topnav">
    <a href="PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.php">Promo</a>
    <a href="PerfumerFragrances.php">Fragrances</a>
    <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>
    <a style="float:right" href="../../backend/utils/userRelated/Logout.php">Logout</a>
    <a href="PerfumerMyProfile.php">My Profile</a>
    <a href="PerfumerContact.php" style="float:right">Contact</a>
</div>
<?php if (isset($_SESSION["userName"])) : ?>
    <div class="leftcolumn">
        <div class="card">
            <div class="leftcolumn">
                <div class="contactForm">
                    <h3>Name:</h3>
                    <p id="userName"><?= $_SESSION["userName"] ?></p>
                    <br>
                    <h3>Email:</h3>
                    <p id="userEmail"><?= $_SESSION["userEmail"] ?></p>
                    <br>
                    <h3>Notes</h3>
                    <div class="fragranceNotes" id="fragranceNotes">
                        <?php foreach (PerfumeModel::notes as $note): ?>
                            <label class="container"><?= $note ?>
                                <input type="checkbox" value="<?= $note ?>" id="notes" name="notes[]">
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <br><br>
                </div>
                <div class="card">
                    <h2>My commands</h2>
                    <div class="myCommandsWrapper" id="myCommandsWrapper">

                    </div>
                </div>
            </div>
            <div class="rightcolumn">
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
                <h3>Seasons</h3>
                <div class="fragranceSeason">
                    <?php foreach (PerfumeModel::seasons as $season): ?>
                        <label class="radioContainer"><?= $season ?>
                            <input type="radio" checked="checked" value="<?= $season ?>" id="seasons" name="seasons[]">
                            <span class="radioCheckmark"></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <script src="../../scripts/limitCheckBoxProfile.js"></script>
                <br>
                <label for="address1">My delivery address
                    <br>
                    <input type="text" name="subject" id="inputDeliveryAddress" class="inputDeliveryAddress"
                           placeholder="Enter your delivery address..">
                </label>
                <p id="userAddress" class="userAddress"></p>
                <br><br>
                <div class="UpdateInfo">
                    <button onclick="setUserAddress('inputDeliveryAddress','userAddress')">Set user address</button>
                    <br><br>
                    <button onclick="updateUserData()">Update user info</button>
                    <br><br>
                </div>
                <script src="../../scripts/updateUserInfo.js"></script>
                <script src="../../scripts/ajaxRelated.js"></script>
            </div>
        </div>
    </div>

<?php else : ?>
<?php endif; ?>
</body>
</html>
