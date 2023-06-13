<?php

function isConnect() {
    if(isset($_SESSION['status']))
    {
        return false ;
    }else{
        return true ;
    }
}

function isAdmin() {
    if(isset($_SESSION['status']) && $_SESSION['status'] == 1)
    {
        return true ;
    }else {
        return false ;
    }
}