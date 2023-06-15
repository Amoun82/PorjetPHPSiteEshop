<?php

function isConnect() {
    if(isset($_SESSION['menbre']['status']))
    {
        return false ;
    }else{
        return true ;
    }
}

function isAdmin() {
    if(isset($_SESSION['menbre']['status']) && $_SESSION['menbre']['status'] == 1)
    {
        return true ;
    }else {
        return false ;
    }
}