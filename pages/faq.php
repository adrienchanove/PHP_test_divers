<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '\ini.php';
$acceptedAccount =
[
    'adrien' => 'adrien',
    'admin' => 'admin'
];

Auth::check($acceptedAccount, 'FAQ');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
</head>
<body>
    necessite un compte et tu dois etre adrien pour y acceder
    Bravo tu as reussi a acceder a la page
</body>
</html>