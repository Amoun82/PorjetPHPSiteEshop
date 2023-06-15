<?php
require_once "../inc/init.inc.php";
require_once "../inc/function.inc.php";

if (!isAdmin()) {
    header('location:../_index.php');
    exit();
}
