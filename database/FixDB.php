<?php
include_once 'C:\wamp\www\ADSS-Prototype\help_functions.php';

class FixDB {

    public static function convertDate($id) {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`anion_gap` where id=".$id." ORDER BY `anion_gap`.`Date.Time` ASC";
        $result = $db->createQuery($q);
        if(count($result)> 0) {
            return $result;
        } else {
            return FALSE;
        }

        /*$q = "INSERT INTO `adss`.`los` (`id`, `day1`) VALUES
              ('{$patient_id}','{$first_day}');";
        $db->createQuery($q);*/
    }

    public static function getMaxId() {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`anion_gap` group by id order by id DESC limit 1";
        $result = $db->createQuery($q);
        return $result;
    }

    public static function getMaxDateCountFromAllTables() {
        $db = new Database();
        // From anion
        $q = "SELECT count(*) as max_rows FROM `anion_gap` GROUP BY `id` order by max_rows DESC limit 1";
        $result = $db->createQuery($q);
        $current_max = $result[0]['max_rows'];
        return $current_max;
    }

    public static function alterTable() {
        $db = new Database();
        for($i=232; $i<=316; $i++)
        {
            $q = "ALTER TABLE `los` ADD date".$i." DATETIME";
            $db->createQuery($q);
        }
    }

    public static function getMedian($id) {
        $db = new Database();
        $q = "select `Value` from `calcium1` where `rand.id`=".$id;
        $res = $db->createQuery($q);
        $new_res = array();
        $size = count($res);
        for($i=0; $i<$size; $i++)
        {
            array_push($new_res, $res[$i]['Value']);
        }
        return $new_res;
    }

    public static function getMean($id) {
        $db = new Database();
        $q = "select TRUNCATE(AVG(`Value`),2) as mean from `creatinine` where `rand.id`=".$id;
        $res = $db->createQuery($q);
        return $res[0]['mean'];
    }

    public static function getMax($id) {
        $db = new Database();
        $q = "select MAX(`Value`) as max from `creatinine` where `rand.id`=".$id;
        $res = $db->createQuery($q);
        return $res[0]['max'];
    }

    /**
     * insert patient vector
     */
    public static function insertPatientVec($id, $median, $mean, $max) {
        $db = new Database();
        $q = "UPDATE `adss`.`patients_vectors` SET `creatinine_median`=$median, `creatinine_mean`=$mean, `creatinine_max`=$max WHERE `id`=".$id;
        $db->createQuery($q);

    }

    /**
     * @param $id
     * @return the count of dates
     */
    public static function getAllDatesForId($id) {
        $db = new Database();
        $q =    "SELECT count(*) as cnt from
                (SELECT `id`,`Date.Time` FROM `anion_gap` WHERE `id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `bicarbonate1` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `id`,`Date.Time` FROM `bicarbonate2` WHERE `id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `bun` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `calcium1` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `id`,`Date.Time` FROM `calcium2` WHERE `id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `creatinine` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `hematocrit1` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `id`,`Date.Time` FROM `hematocrit2` WHERE `id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `hemoglobin` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `magnesium` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `phosphate` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `platelets` WHERE `rand.id`=".$id."
                UNION ALL
                SELECT `id`,`date` FROM `sofa` WHERE `id`=".$id."
                UNION ALL
                SELECT `rand.id`,`Date.Time` FROM `wbc` WHERE `rand.id`=".$id."
                order by 2 ASC
                ) as T";
        $result = $db->createQuery($q);
        return $result[0]["cnt"];
    }

    /**
     * update a new user to database
     */
    public static function insertUser($username, $password, $name, $auth) {
        $db = new Database();
        $q = "INSERT INTO `adss`.`users` (`username`, `password`, `name`, `auth`) VALUES
             ('{$username}','{$password}', '{$name}', '{$auth}');";
        return $db->createQuery($q);
    }

    /**
     * get user from database
     * return false if was not found
     * @param - $user - a user name to search for
     */
    public static function getUser($user) {
        $db = new Database();
        $q = "SELECT * FROM users WHERE username='{$user}'";
        $result = $db->createQuery($q);
        if (count($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }
}