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
        $q = 'SELECT `id`, `length of stay` as los, age, gender FROM patients ORDER BY `admission_time` DESC LIMIT 4';
        $result = $db->createQuery($q);
        return $result;
    }

    public static function getPatientById($id) {
        $db = new Database();
        $q = 'SELECT `id`, `length of stay` as los, age, gender FROM patients WHERE `id`='.$id;
        $result = $db->createQuery($q);
        return $result;
    }

    public static function getPatientParams($id) {
        $db = new Database();
        $q = 'SELECT  FROM patients WHERE `id`='.$id;
        $result = $db->createQuery($q);
        return $result;
    }
}
