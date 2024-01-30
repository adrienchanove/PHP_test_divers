<?php
/**
 * User model
 */
class User extends Model
{
    private $id;
    public $username;
    private $password;

    public function __construct() {
        $id = null;
    }

    static public function verifySql()
    {
        $bdd = new Bdd();
        $sql = "CREATE TABLE IF NOT EXISTS User ( 
            id            INTEGER         PRIMARY KEY AUTOINCREMENT,
            username         VARCHAR( 250 ),
            password       VARCHAR( 250 )
        );";
        $bdd->execute($sql);
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
        return password_verify($password, $this->password);
    }
   
}