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
    }
?>