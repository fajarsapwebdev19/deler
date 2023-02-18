<?php
    $current_page = 'home';

    if(array_key_exists('page', $_GET))
    {
        $current_page = $_GET['page'];
    }

    switch($current_page)
    {
        case 'home';
        require 'page/home.php';
        break;

        case 'tcash';
        require 'page/tcash.php';
        break;

        case 'tkredit';
        require 'page/tkredit.php';
        break;

        case 'profile';
        require 'page/profile.php';
        break;
    }
?>