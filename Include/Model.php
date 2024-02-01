<?php

/**
 * Model
 */

 interface   Model
{
    /**
     * Get a record by id
     * @param int $id
     * @return Model
     */
    static function getById($id);
    
    /**
     * Get all records
     * @return Model[]
     */
    static function getAll();

    /**
     * Array to entity
     * Process array to entity
     * @param array $array
     */
    function arrayToEntity($array);

    /**
     * Save instance in database
     */
    public function save();

    /**
     * lastInsertId
     * @return int
     */
    static function lastInsertId();
    
}
