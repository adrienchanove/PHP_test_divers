<?php

/**
 * Model
 */

class Model
{
    static function getById($id)
    {
        $table = get_called_class();
        $sql = "SELECT * FROM $table WHERE id = $id";
        $bdd = new Bdd();
        $result = $bdd->execute($sql);
        $all = $result->fetch(PDO::FETCH_ASSOC);
        $listeInstance = [];
        foreach ( $all as $entite ) {
            $listeInstance[] = self::arrayToEntity($entite);
        }
        return $listeInstance;
    }

    static function getAll()
    {
        $table = get_called_class();
        $sql = "SELECT * FROM $table";
        $bdd = new Bdd();
        $result = $bdd->execute($sql);
        $all = $result->fetchAll(PDO::FETCH_ASSOC);
        $listeInstance = [];
        foreach ( $all as $entite ) {
            $listeInstance[] = self::arrayToEntity($entite);
        }
        return $listeInstance;
    }

    private function arrayToEntity($array)
    {
        $table = get_called_class();
        $instance = new $table();
        foreach ( $array as $key => $value ) {
            $instance->$key = $value;
        }
        return $instance;
    }
}
