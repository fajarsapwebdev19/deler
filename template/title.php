<?php
    $current_page = "login";

    if(array_key_exists('page', $_GET))
    {
        $current_page = $_GET['page'];
    }

    switch($current_page)
    {
        case 'login';
        $title = "Login";
        break;

        case 'register';
        $title = "Register Account User";
        break;
    }
?>