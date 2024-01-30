<?php


/**
 * User Controller
 * 
 */
class UserController {
    
        /**
        * Page d'accueil
        */
        public function login()
        {
            // Check auth
            if (Auth::isLogged()) {
                header("location: /");
                exit;
            }
            // Check post
            if (isset($_POST['username']) && isset($_POST['password'])) {
                if (Auth::login($_POST['username'], $_POST['password'])) {
                    header("location: /");
                    exit;
                } else {
                    $error = "Identifiants incorrects";
                }
            }
            // open view
            view('user/login', ['error' => $error ?? '']);
        }


}
