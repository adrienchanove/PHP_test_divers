<?php


class Auth
{
    public static function login($username, $password)
    {
        $user = User::getByUsername($username);
        if (is_null($user)) {
            return false;
        }
        if ($user->checkPassword($password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            return true;
        }
    }

    public static function logout()
    {
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = '';
    }

    public static function isLogged()
    {
        return $_SESSION['loggedin'] ?? false;
    }

    public static function getUsername()
    {
        return $_SESSION['username'] ?? '';
    }

    public static function check($acceptedAccount, $refererName = '')
    {
        $referer = $_SERVER['REQUEST_URI'] ?? '/';
        if ($refererName == '') {
            $refererName =  $referer;
        }

        if (!self::isLogged()) {
            header("location: /login.php?rfn=" . $refererName . "&rf=" . $referer);
            exit;
        } else {
            if (!isset($acceptedAccount[self::getUsername()])) {
                include $_SERVER['DOCUMENT_ROOT'] . '\include\403.php';
                exit;
            }
        }
    }
}
