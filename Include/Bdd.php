<?php

/**
 * Database class
 * Connect to SQLite database
 */

//include_once ROOT_CONF . 'DB.php';

class Bdd
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * Bdd constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . ROOT_CONF . 'database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    }

    /**
     * @param $sql
     * @param array $params
     * @return PDOStatement
     */
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * resetDatabase
     */
    public function resetDatabase()
    {
        // load file resetDatabase.sql
        $sql = file_get_contents(ROOT_CONF . 'resetDatabase.sql');
        $this->pdo->exec($sql);
    }
}
