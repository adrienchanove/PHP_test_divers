<?php

/**
 * User model
 */
class User implements Model
{
    public $id;
    public $username;
    public $password;
    public $group_id;

    /**
     * User constructor.
     */
    public function __construct()
    {
        // default id = null (not exist in database)
        $this->id = null;
        // default group_id = 1 (user)
        $this->group_id = 1;
    }

    /**
     * Array to entity
     * Process array to entity
     * @param array $array
     */
    function arrayToEntity($array)
    {
        $this->id = $array['id'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->group_id = $array['group_id'];
    }

    /**
     * Save user in database
     */
    public function save()
    {

        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateUser = "UPDATE User SET username = '$this->username', password = '$this->password' WHERE id = $this->id";
            $bdd->execute($sqlUpdateUser);
        } else {
            // check if username already exist
            $user = self::getByUsername($this->username);
            if ($user != null) {
                throw new Exception('Username already exist');
            }
            $sqlInsertUser = "INSERT INTO User (username, password) VALUES ('$this->username', '$this->password')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertUser);
            $this->id = self::lastInsertId();
            $sqlInsertUserGroup = "INSERT INTO UserGroup (user_id, group_id) VALUES ($this->id, $this->group_id)";
            $bdd->execute($sqlInsertUserGroup);
        }
    }

    /**
     * Get a record by id
     * @param int $id
     * @return User
     */
    static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User JOIN userGroup ON User.id = userGroup.user_id WHERE User.id = $id";
        $stmt = $bdd->execute($sql);
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($users == false) {
            return null;
        }
        $listUsers = [];
        foreach ($users as $user) {
            $usr = new User();
            $usr->arrayToEntity($user);
            $listUsers[] = $usr;
        }
        return $listUsers[0];
    }

    /**
     * Get all records
     * @return User[]
     */
    static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User JOIN userGroup ON User.id = userGroup.user_id";
        $stmt = $bdd->execute($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($users == false) {
            return null;
        }
        $listUsers = [];
        foreach ($users as $user) {
            $usr = new User();
            $usr->arrayToEntity($user);
            $listUsers[] = $usr;
        }
        return $listUsers;
    }

    /**
     * Get a user by its username
     * @return array
     */
    static public function getByUsername($username)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User JOIN userGroup ON User.id = userGroup.user_id WHERE username = '$username'";
        $stmt = $bdd->execute($sql);
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($users == false) {
            return null;
        }
        $listUsers = [];
        foreach ($users as $user) {
            $usr = new User();
            $usr->arrayToEntity($user);
            $listUsers[] = $usr;
        }
        return $listUsers;
    }

    /**
     * Check if password is correct
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return $password == $this->password;
    }

    /**
     * lastInsertId
     * @return int
     */
    static public function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) FROM User";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetchColumn();
        return $id;
    }

    /**
     * Get group name
     * @return string
     */
    public function getGroupName()
    {
        $bdd = new Bdd();
        $sql = "SELECT Group.name FROM UserGroup INNER JOIN Group ON UserGroup.group_id = Group.id WHERE UserGroup.user_id = $this->id";
        $stmt = $bdd->execute($sql);
        $groupName = $stmt->fetchColumn();
        return $groupName;
    }
   
}
