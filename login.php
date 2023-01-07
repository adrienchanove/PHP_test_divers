<?php
// Page de connexion

// Include ini.php file
require_once $_SERVER['DOCUMENT_ROOT']."/ini.php";



// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['loggedin'] = false;
}

// Get referer
$referer =  $_GET['rf']?? '/';

// Get referer name
$refererName = $_GET['rfn']?? $refer;


// If the user is logged in, redirect to the home page
if ($_SESSION['loggedin'] == true) {
    header("location: /");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $username = $_POST['username']?? '';
    $password = $_POST['password']?? '';

    // Check if the user is logged in
    if (Auth::login($username, $password)) {
        header("location: $referer");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Login pour <?= $refererName?></h1>
        <h2>Lien : <?= $referer ?></h2>
    </header>
    
    <form  method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Se connecter">
    </form>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

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
            flex-direction: column;
            justify-content: space-between;
            align-items: center;

        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
        }
        form label {
            margin-top: 10px;
        }
        form input {
            margin-top: 5px;
        }

        form input[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</body>
</html>