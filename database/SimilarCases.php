<?php
include_once 'C:\wamp\www\ADSS-Prototype\help_functions.php';

class SimilarCases
{

    public static function convertDate($id)
    {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`anion_gap` where id=" . $id . " ORDER BY `anion_gap`.`Date.Time` ASC";
        $result = $db->createQuery($q);
        if (count($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public static function getMaxId()
    {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`anion_gap` group by id order by id DESC limit 1";
        $result = $db->createQuery($q);
        return $result;
    }

    public static function getMaxDateCountFromAllTables()
    {
        $db = new Database();
        // From anion
        $q = "SELECT count(*) as max_rows FROM `anion_gap` GROUP BY `id` order by max_rows DESC limit 1";
        $result = $db->createQuery($q);
        $current_max = $result[0]['max_rows'];
        return $current_max;
    }
}