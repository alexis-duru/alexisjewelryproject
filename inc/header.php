<?php require 'inc/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Des bijoux en or et en argent">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>AlexisJewelry</title>
</head>

<body>
    <header>
        <div id="header-top">
            <h1>
                <a href='index.php'>ALEXISJEWELRY</a>
            </h1>
        </div>
        <nav>
            <ul>
                <li>
                    <a href='index.php'>HOME</a>
                </li>
                <li>
                    <a href='products.php'>SHOP</a>
                </li>
                <?php if(!empty($_SESSION['id'])) { ?>
                <li>
                    <a href='profile.php'>PROFILE</a>
                </li>
                <li>
                    <a href='?logout'>LOGOUT</a>
                </li>
                <?php }else{ ?>
                <li>
                    <a href='login.php'>LOGIN</a>
                </li>
                <li>
                    <a href='register.php'>REGISTER</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </header>