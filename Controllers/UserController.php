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

        /**
         * Page register
         */
        public function register()
        {
            // Check auth
            if (Auth::isLogged()) {
                header("location: /");
                exit;
            }
            // Check post
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $user = new User();
                $user->username = $_POST['username'];
                $user->setPassword($_POST['password']);
                $user->save();
                header("location: /login");
                exit;
            }
            // open view
            view('user/register');
        }

        /**
         * Page logout
         */
        public function logout()
        {
            Auth::logout();
            header("location: /");
            exit;
        }

        /**
         * Page profile
         */
        public function profile()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // open view
            view('user/profile');
        }

        /**
         * Page edit
         */
        public function edit()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // Check post
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $user = User::getByUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                $user->save();
                header("location: /profile");
                exit;
            }
            // open view
            view('user/edit');
        }

        /**
         * Page faq
         */
        public function faq()
        {
            // open view
            view('faq');
        }


}
