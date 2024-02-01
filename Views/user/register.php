<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <header>
        <h1>Register</h1>
    </header>

    <form method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="S'enregistrer">
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