<?php
ob_start();
require_once('../../../config/Settings.php');
require_once('../../../backend/utils/userRelated/GoogleLoginApi.php');
require_once('../../../backend/database/DbConnection.php');
require_once('../../../backend/model/PerfumeModel.php');
require_once('../../../backend/controller/UserDataController.php');
GoogleLoginApi::startSession();

$redirect = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
    '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
    '&access_type=online';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Admin Page</title>
    <style>
        <?php include '../../styles/PerfumerAdminStyles.css'; ?>
    </style>
</head>

<body>
<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <?php if ($_SESSION["userName"] == 'Admin') : ?>
        <h1>Administrator of fragrances</h1>
    <?php else : ?>
        <h1>Please login to view this content</h1>
    <?php endif; ?>
</div>
<div class="topnav">
    <a href="../PerfumerIndex.php">Home</a>
    <a href="../PerfumerPromo.php">Promo</a>
    <a href="../PerfumerFragrances.php">Fragrances</a>
    <a href="../PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>

    <?php if (!isset($_SESSION["userName"])) : ?>
        <a href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= $redirect ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right" href="../../../backend/utils/userRelated/Logout.php">Logout</a>
        <?php if ($_SESSION["userName"] == 'Admin') : ?>
            <a href="AdminPage.php">Admin Page</a>
        <?php else : ?>
            <a href="../PerfumerMyProfile.php">My Profile</a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!($_SESSION["userName"] == 'Admin')) : ?>
        <a href="../PerfumerContact.php" style="float:right">Contact</a>
    <?php endif; ?>
</div>
<?php if ($_SESSION["userName"] == 'Admin') : ?>
    <div class="card">
        <div class="leftcolumn">
            <div class="ReportCriteria">
                <h3>By notes</h3>
                <div class="fragranceNotes" id="fragranceNotes">
                    <?php foreach (PerfumeModel::notes as $note): ?>
                        <label class="container"><?= $note ?>
                            <input type="checkbox" value="<?= $note ?>" id="notes" name="notes[]">
                            <span class="checkmark"></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <br><br>
                <label class="container">By Stock
                    <input type="checkbox" value="By Stock" id="byStock" name="byStock">
                    <span class="checkmark"></span>
                </label>
                <br><br>
                <label for="emailAddressLabel">By e-mail address
                    <br>
                    <input type="text" name="subject" id="inputEmailAddress" class="inputEmailAddress"
                           placeholder="Enter the email address..">
                </label>
                <p id="emailAddress" class="emailAddress"></p>
                <br>
                <div class="updateEmailAddress">
                    <button class="setEmail" onclick="setUserAddress('inputEmailAddress','emailAddress')">Set email
                        Address
                    </button>
                    <button class="resetEmail" onclick="resetMailAddress()">Reset User Email</button>
                </div>
                <br>
                <script src="../../../scripts/limitCheckBoxProfile.js"></script>
                <script src="../../../scripts/updateUserInfo.js"></script>
                <script src="../../../scripts/ajaxRelated.js"></script>
            </div>
        </div>
        <div class="rightcolumn">
            <h3>By occasion</h3>
            <div class="fragranceOccasions">
                <?php foreach (PerfumeModel::occasions as $occasion): ?>
                    <label class="container"><?= $occasion ?>
                        <input type="checkbox" value="<?= $occasion ?>" id="occasions"
                               name="occasions[]">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <br>
            <h3>By Season</h3>
            <div class="fragranceSeason">
                <?php foreach (PerfumeModel::seasons as $season): ?>
                    <label class="container"><?= $season ?>
                        <input type="checkbox" value="<?= $season ?>" id="seasons" name="seasons[]">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <br><br>
            <form action="/action_page.php">
                <label>
                    From: <input type="date" name="fromDate" id="fromDate" class="fromDate">
                    To: <input type="date" name="toDate" id="toDate" class="toDate">
                    <input type="submit">
                </label>
            </form>
            <br><br>
            <div class="reportsButtons">
                <button class="pdfReport" id="pdfReport">PDF Report</button>
                <button class="pdfReport" id="pdfReport">HTML Report</button>
                <button class="pdfReport" id="pdfReport">CSV Report</button>
            </div>
        </div>
    </div>
<?php else : ?>
<?= GoogleLoginApi::destroySession() ?>
<?php endif; ?>
</body>

</html>