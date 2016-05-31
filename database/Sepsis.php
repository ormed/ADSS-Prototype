<?php
include_once 'Database.php';


class Sepsis {

    /**
     * get the bicarbonate results by id
     * @param $id - the patient id
     * @return array of all the bicarbonate results
     */
    public static function getBicarbonateById($id) {
        $db = new Database();
        $q = "SELECT `value` as `Bicarbonate`, `time` as Time FROM `bicarbonate_results` WHERE `patient_id`=".$id." ORDER BY `time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the bun results by id
     * @param $id - the patient id
     * @return array of all the bun results
     */
    public static function getBunById($id) {
        $db = new Database();
        $q = "SELECT `value` as `Bun`, `time` as Time FROM `bun_results` WHERE `patient_id`=".$id." ORDER BY `time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the anion gap results by id
     * @param $id - the patient id
     * @return array of all the anion gap results
     */
    public static function getAnionGapById($id) {
        $db = new Database();
        $q = "SELECT `value` as `Anion Gap`, `time` as Time FROM `anion_gap_results` WHERE `patient_id`=".$id." ORDER BY `time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the anion creatinine results by id
     * @param $id - the patient id
     * @return array of all the creatinine results
     */
    public static function getCreatinineById($id) {
        $db = new Database();
        $q = "SELECT `value` as `Creatinine`, `time` as Time FROM `creatinine_results` WHERE `patient_id`=".$id." ORDER BY `time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the patient probability to have sepsis
     * @param $id - the patient id
     * @return probability to have sepsis
     */
    public static function getProbability($id) {
        $db = new Database();
        $q = "SELECT probability FROM `sepsis` WHERE `rand.id`=".$id;
        $result = $db->createQuery($q);
        if(count($result) > 0) {
            return $result[0]['probability'];
        } else {
            return "";
        }
    }
}