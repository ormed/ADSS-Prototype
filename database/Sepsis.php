<?php
include_once 'C:\wamp\www\ADSS-Prototype\help_functions.php';


class Sepsis {

    /**
     * get the bicarbonate results by id
     * @param $id - the patient id
     * @return array of all the bicarbonate results
     */
    public static function getBicarbonateById($id) {
        $db = new Database();
        $q = "SELECT `value` as Bicarbonate, `time` as Time FROM `bicarbonate_results` WHERE `patient_id`=".$id." ORDER BY `time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }
}