<?php
include_once 'Database.php';


class Mortality {

    /**
     * get the patient probability to live/die from sofa prediction
     * @param $id - the patient id
     * @return probability
     */
    public static function getProbability($id) {
        $db = new Database();
        $q = "SELECT * FROM `sofa_results` WHERE `id`=".$id;
        $result = $db->createQuery($q);
        return $result;
    }
}