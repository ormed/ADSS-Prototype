<?php
include_once 'C:\wamp\www\ADSS-Prototype\help_functions.php';


class Patient {

    /**
     * get all patients in db
     * @return array $result - all patients
     */
    public static function getPatients() {
        $db = new Database();
        $q = 'SELECT * FROM patients';
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get all patients ids in db
     * @return array $result - all patients ids
     */
    public static function getPatientsId() {
        $db = new Database();
        $q = 'SELECT id FROM patients';
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get last 4 patients in icu
     * @return array $result - patients in icu
     */
    public static function getBedPatients() {
        $db = new Database();
        $q = 'SELECT p.`id`, p.`length of stay` as los, a.`Value` as age FROM patients p, age a WHERE a.`rand.id`=p.`id` ORDER BY p.`admission_time` LIMIT 4';
        $result = $db->createQuery($q);
        return $result;
    }
}
