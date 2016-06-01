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
     * get patient results from parameters in POST
     * @return array $result - selected patients results
     */
    public static function getPatientResultsById($id) {
        $db = new Database();
        $i = 1;
        $q = "SELECT `".$_POST["param_". $i]."`";
        $i++;
        while(isset($_POST['param_'.$i])) {
            $q.=", `".$_POST["param_".$i]."`";
            $i++;
        }
        $q .= "FROM `patients_results` WHERE id=".$id;
        $result = $db->createQuery($q);
        debug($result);
        return $result;
    }

    /**
     * get all patient results
     * @return array $result - all patients results
     */
    public static function getAllPatientResultsById($id) {
        $db = new Database();
        $q = "SELECT * FROM `patients_results` WHERE id=".$id;
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get all patient results columns (Min Creatinine, Max Creatinine, Mean Creatinine...)
     * @return array $result - all patients results columns
     */
    public static function getAllParameters() {
        $db = new Database();
        $q = 'SHOW COLUMNS FROM `patients_results` FROM `adss`';
        $result = $db->createQuery($q);
        return $result;
    }

    /**
     * get last 4 patients in icu
     * @return array $result - patients in icu
     */
    public static function getBedPatients() {
        $db = new Database();
        //$q = 'SELECT `id`, `length of stay` as los, age, gender FROM patients ORDER BY `admission_time` DESC LIMIT 4';
        $q = "SELECT `id`, `length of stay` as los, age, gender FROM patients WHERE `id`='3320' OR `id`='3321' OR `id`='3322' OR `id`='3350'";
        $result = $db->createQuery($q);
        return $result;
    }

    public static function getPatientById($id) {
        $db = new Database();
        $q = 'SELECT `id`, `length of stay` as los, age, gender FROM patients WHERE `id`='.$id;
        $result = $db->createQuery($q);
        return $result;
    }
}
