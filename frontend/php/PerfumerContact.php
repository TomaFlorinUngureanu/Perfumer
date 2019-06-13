<?php
error_reporting(0);
ob_start();
require_once('../../config/Settings.php');
require_once('../../backend/utils/userRelated/GoogleLoginApi.php');
require_once('../../libs/PHPMailer_5.2.4/class.phpmailer.php');
require_once('../../backend/utils/userRelated/MailFunctionality.php');

GoogleLoginApi::startSession();
$mailFunctionality = new MailFunctionality();
$mailFunctionality->setFields();

$redirect = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') .
    '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID .
    '&access_type=online';
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
    <h1>Contact</h1>
</div>
<div class="topnav">
    <a href="PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.php">Promo</a>
    <a href="PerfumerFragrances.php">Fragrances</a>
    <a href="PerfumerShoppingCart.php" style="float:right">Shopping Cart</a>

    <?php if (!isset($_SESSION["userName"])) : ?>
        <a href="https://accounts.google.com/o/oauth2/auth?scope=
    <?= $redirect ?>" style="float:right">Login</a>
    <?php else : ?>
        <a style="float:right" href="../../backend/utils/userRelated/Logout.php">Logout</a>
        <a href="PerfumerMyProfile.php">My Profile</a>
    <?php endif; ?>

    <a href="PerfumerContact.php" style="float:right">Contact</a>
</div>
<div class="contactForm">
    <h3>Send us some feedback</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your name.." required>
        <p><?php if (isset($name_error)) echo $mailFunctionality->getNameError(); ?></p>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Your email.." required>
        <p><?php if (isset($email_error)) echo $mailFunctionality->getEmailError(); ?></p>
        <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Subject.." required>
        <p><?php if (isset($subject_error)) echo $mailFunctionality->getSubjectError(); ?></p>
        <label for="message">Message</label>
        <textarea name="message" placeholder="Write something.." style="height:200px" required></textarea>
        <p><?php if (isset($message_error)) echo $mailFunctionality->getMessageError(); ?></p>
        <input type="submit" name="submit" value="Submit">
        <?php $mailFunctionality->sendFeedback();?>
    </form>
</div>
</body>
</html>
