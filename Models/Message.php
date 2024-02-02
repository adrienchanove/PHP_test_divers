<?php
class Message implements Model
{
    public $id;
    public $sender_id;
    public $receiver_id;
    public $message;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->id = null;
    }

    /**
     * Array to entity
     * Process array to entity
     */
    public function arrayToEntity($array)
    {
        $this->id = $array['id'];
        $this->sender_id = $array['sender_id'];
        $this->receiver_id = $array['receiver_id'];
        $this->message = $array['message'];
    }

    /**
     * Save message in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateMessage = "UPDATE Message SET sender_id = '$this->sender_id', receiver_id = '$this->receiver_id', message = '$this->message' WHERE id = $this->id";
            $bdd->execute($sqlUpdateMessage);
        } else {
            $sqlInsertMessage = "INSERT INTO Message (sender_id, receiver_id, message) VALUES ('$this->sender_id', '$this->receiver_id', '$this->message')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertMessage);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Delete message from database
     * @return null|Message
     */
    public static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Message WHERE id = $id";
        $stmt = $bdd->execute($sql);
        $array = $stmt->fetch();
        if ($array == false) {
            return null;
        }
        $message = new Message();
        $message->arrayToEntity($array);
        return $message;
    }

    /**
     * Get all messages
     * @return array[Message]
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Message";
        $stmt = $bdd->execute($sql);
        $array = $stmt->fetchAll();
        $messages = array();
        foreach ($array as $message) {
            $m = new Message();
            $m->arrayToEntity($message);
            $messages[] = $m;
        }
        return $messages;
    }


    /**
     * Get all messages user id (sender or receiver)
     * @param $user_id1
     * @param $user_id2
     * @return array[Message]
     */
    public static function getByUsersIds($user_id1, $user_id2)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Message WHERE (sender_id = $user_id1 AND receiver_id = $user_id2) OR (sender_id = $user_id2 AND receiver_id = $user_id1)";
        $stmt = $bdd->execute($sql);
        $array = $stmt->fetchAll();
        $messages = array();
        foreach ($array as $message) {
            $m = new Message();
            $m->arrayToEntity($message);
            $messages[] = $m;
        }
        return $messages;
    }

    /**
     * Get last inserted id
     * @return int
     */
    public static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) FROM Message";
        $stmt = $bdd->execute($sql);
        return $stmt->fetchColumn();
    }

    /**
     * Get all messages from a user
     * @param $user_id
     * @return array[Message]
     */
    public static function getByUserId($user_id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Message WHERE sender_id = $user_id OR receiver_id = $user_id";
        $stmt = $bdd->execute($sql);
        $array = $stmt->fetchAll();
        $messages = array();
        foreach ($array as $message) {
            $m = new Message();
            $m->arrayToEntity($message);
            $messages[] = $m;
        }
        return $messages;
    }

    /**
     * Get with who the user is talking
     * @param $user_id
     * @return array[User]
     */
    public static function getWithWhoUserIsTalking($user_id)
    {
        $bdd = new Bdd();
        $sql = "SELECT DISTINCT sender_id, receiver_id FROM Message WHERE sender_id = $user_id OR receiver_id = $user_id";
        $stmt = $bdd->execute($sql);
        $array = $stmt->fetchAll();
        $users = array();
        foreach ($array as $user) {
            if ($user['sender_id'] == $user_id) {
                $users[] = $user['receiver_id'];
            } else {
                $users[] = $user['sender_id'];
            }
        }

        // remove duplicates
        $users = array_unique($users);
        foreach ($users as $key => $user) {
            $users[$key] = User::getById($user);
        }

        return $users;
    }


}
