<?php
$title = $data['title'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <h1><?= $title ?></h1>
        <?php if (Auth::isLogged()) : ?>
            <a href="logout.php">Logout|<?= Auth::getUsername() ?></a>
        <?php else : ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </header>