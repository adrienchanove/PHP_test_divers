<?php
// include the config file
require_once $_SERVER['DOCUMENT_ROOT']."/ini.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principale</title>
</head>
<body>
    <header>
        <h1>Menu principale</h1>
        <!-- login link-->
        <?php if (Auth::isLogged()) : ?>
            <a href="logout.php">Logout|<?= Auth::getUsername()?></a>
        <?php else : ?>
            <a href="login.php?rfn=Menu+principal&rf=/">Login</a>
        <?php endif; ?>

    </header>
    <h1>Menu principale</h1>
    <ul>
        <li><a href="pages/contact.php">Contacts</a></li>
        <li><a href="pages/faq.php">FAQ</a></li>
        <li><a href="pages/privacy.php">Privacy</a></li>
    </ul>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;

            /* flex */
            display: flex;
            justify-content: space-between;
            align-items: center;

        }
        header h1 {
            margin: 0;
        }
        header a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
            background-color: #222;
            /* round */
            border-radius: 5px;
        }
        header a:hover {
            background-color: #fff;
            color: #333;
        }
       
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
        }
        ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            display: block;
            background-color: #fff;
            border-radius: 5px;
        }
        ul li a:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
    
</body>
</html>