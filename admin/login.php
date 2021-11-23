<?php

require_once('authorization.php');

session_start();

if (!empty($_POST['login']) && !empty($_POST['password']))
{
    if ($_POST['login'] == USERNAME)
    {
        if (password_verify($_POST['password'], PASSWORD))
        {
            $_SESSION['user'] = htmlspecialchars($_POST['login']);  
        }
    }
}

header("Location: http://localhost:80/admin/index.php");  