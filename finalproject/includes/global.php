<?php
    if(!session_id()) session_start();
    if(!isset($_SESSION['board'])) {
        $_SESSION['board'] = "";
        $_SESSION['turns'] = 0;
    }
?>