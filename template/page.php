<?php
    $current_page = "login";

    if(array_key_exists('page', $_GET))
    {
        $current_page = $_GET['page'];
    }

    switch($current_page)
    {
        case 'login';
        require 'page/login.php';
        break;

        case 'register';
        require 'page/register.php';
        break;
    }
?>