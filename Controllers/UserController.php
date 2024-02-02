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
                $user->password = $_POST['password'];
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
                $user->password = $_POST['password'];
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



        /**
         * Page message
         */
        public function message()
        {
            $data = [];
            // get with who the user is talking 
            $currentUser = User::getByUsername(Auth::getUsername());
            $data['currentUser'] = $currentUser;

            if (isset($_POST['content'])) {
                $message = new Message();
                $message->sender_id = $currentUser->id;
                $message->receiver_id = $_POST['receiver_id'];
                $message->message = $_POST['content'];
                $message->save();
                header("location: /message?receiver=" . User::getById($message->receiver_id)->username);
                exit;
            }

            $speakingWith = Message::getWithWhoUserIsTalking($currentUser->id);
            $data['speakingWith'] = $speakingWith;
            $canspeakWith = [];
            $allUsers = User::getAll();
            foreach ($allUsers as $user) {
                if ($user->id != $currentUser->id) {
                    if (!in_array($user, $speakingWith)) {
                        $canspeakWith[] = $user;
                    }
                }
            }
            $data['canspeakWith'] = $canspeakWith;


            if (isset($_GET['receiver']))
            {
                $receiver = User::getByUsername($_GET['receiver']);
                $messages = Message::getByUsersIds($currentUser->id, $receiver->id);
                $data['messages'] = $messages;
                $data['receiver'] = $receiver;
            }
            // open view
            view('user/message', $data);
        }


        /**
         * Page admin
         */
        public function admin()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // open view
            view('admin/admin');
        }

        /**
         * Page admin_bdd
         */
        public function admin_bdd()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // Check get
            if (isset($_GET['reset'])) {
                $bdd = new Bdd();
                $bdd->resetDatabase();
                header("location: /admin/bdd");
                exit;
            }
            // open view
            view('admin/db');
        }


}
