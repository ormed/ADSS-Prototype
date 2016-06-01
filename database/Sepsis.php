<?php
include_once 'Database.php';


class Sepsis {

    /**
     * get the heart rate results by id
     * @param $id - the patient id
     * @return array of all the heart rate results
     */
    public static function getHeartRateById($id) {
        $db = new Database();
        $q = "SELECT `Value` as `Heart Rate`, `Date.Time` as Time FROM `heart_rate` WHERE `rand.id`=".$id." ORDER BY `Date.Time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the respiratory rate results by id
     * @param $id - the patient id
     * @return array of all the respiratory rate results
     */
    public static function getRespiratoryRateById($id) {
        $db = new Database();
        $q = "SELECT `Value` as `Respiratory Rate`, `Date.Time` as Time FROM `respiratory_rate` WHERE `rand.id`=".$id." ORDER BY `Date.Time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the temperature results by id
     * @param $id - the patient id
     * @return array of all the temperature results
     */
    public static function getTemperatureById($id) {
        $db = new Database();
        $q = "SELECT `Value` as `Temperature`, `Date.Time` as Time FROM `tmp_results` WHERE `rand.id`=".$id." ORDER BY `Date.Time` ASC";
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get the anion creatinine results by id
     * @param $id - the patient id
     * @return array of all the creatinine results
     */
    public static function getMeanArterialPressureById($id) {
        $db = new Database();
        $q = "SELECT `Value` as `Mean Arterial Pressure`, `Date.Time` as Time FROM `map_results` WHERE `rand.id`=".$id." ORDER BY `Date.Time` ASC";
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