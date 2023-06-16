<?php
require_once "./inc/init.inc.php";
require_once "./inc/function.inc.php";



session_unset();

// On détruit la session
session_destroy();

header('location:./index.php');

require_once "./inc/header.inc.php";
require_once "./inc/nav.inc.php";
require_once "./inc/footer.inc.php" ?>