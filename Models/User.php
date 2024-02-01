<?php
/**
 * User model
 */
class User extends Model
{
    public $id;
    public $username;
    public $password;

    public function __construct() {
        $this->id = null;
    }

    
    
    public function save()
    {
        if ($this->id != null) {
            $sql = "UPDATE User SET username = '$this->username', password = '$this->password' WHERE id = $this->id";
        } else {
            $sql = "INSERT INTO User (username, password) VALUES ('$this->username', '$this->password')";
        }

        $bdd = new Bdd();
        $bdd->execute($sql);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    static public function getByUsername($username)
    {
        $allUser = self::getAll();
        foreach ($allUser as $user) {
            if ($user->username == $username) {
                return $user;
            }
        }
        return null;
    }

    public function checkPassword($password)
    {
        return $password == $this->password;
    }
   
}