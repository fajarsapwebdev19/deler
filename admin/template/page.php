<?php
    $current_page = "home";

    if(array_key_exists('page', $_GET))
    {
        $current_page = $_GET['page'];
    }

    switch($current_page)
    {
        case 'home';
        require 'page/home.php';
        break;

        case 'account';
        require 'page/account.php';
        break;

        case 'merk';
        require 'page/merk.php';
        break;

        case 'motor';
        require 'page/motor.php';
        break;

        case 'tcash';
        require 'page/tcash.php';
        break;

        case 'tkredit';
        require 'page/tkredit.php';
        break;

        case 'konf_kredit';
        require 'page/konf_kredit.php';
        break;

        case 'rep_cash';
        require 'page/rep_cash.php';
        break;

        case 'rep_kredit';
        require 'page/rep_kredit.php';
        break;

        case 'profile';
        require 'page/profile.php';
        break;
    }
?>