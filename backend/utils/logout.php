<?php
require_once("GoogleLoginApi.php");
GoogleLoginApi::startSession();
$_SESSION = array();
header("Location: ../../frontend/php/PerfumerIndex.php");