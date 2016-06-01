<?php
include_once './help_functions.php';

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

    public static function KNN_Algorithm_All_Parameters($id, $numOfNeighbors) {
        // Read the csv file that contains patients parameters
        $data = SimilarCases::getAllParams();

        // Build distance matrix
        $distances = array();
        $distances[$id] = SimilarCases::euclideanDistance($data[$id], $id, $data);
        // Example, target = id 1, getting 10 nearest neighbors
        $neighbors = SimilarCases::getNearestNeighbors($distances, $id, $numOfNeighbors);
        return $neighbors;
    }

    public static function KNN_Algorithm_Selected_Parameters($id, $numOfNeighbors) {
        // Read the csv file that contains patients parameters
        $data = SimilarCases::getPostParams();

        // Build distance matrix
        $distances = array();
        $distances[$id] = SimilarCases::euclideanDistance($data[$id], $id, $data);
        // Example, target = id 1, getting 10 nearest neighbors
        $neighbors = SimilarCases::getNearestNeighbors($distances, $id, $numOfNeighbors);
        return $neighbors;
    }

    public static function getAllParams() {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`normalized_cases` order by `id` ASC";
        $results = $db->createQuery($q);
        $result = array();
        foreach($results as $key=>$value) {
            $result[$value['id']] = array(0=>$value['id'],
                1=>$value['Min Creatinine'], 2=>$value['Max Creatinine'],
                3=>$value['Mean Creatinine'], 4=>$value['Median Creatinine'],
                5=>$value['Min Bilirubin'], 6=>$value['Max Bilirubin'],
                7=>$value['Mean Bilirubin'], 8=>$value['Median Bilirubin'],
                9=>$value['Min Platelets'], 10=>$value['Mean Platelets'],
                11=>$value['Max Platelets'], 12=>$value['Median Platelets'],
                13=>$value['Min Blood Urea Nitrogen'], 14=>$value['Max Blood Urea Nitrogen'],
                15=>$value['Mean Blood Urea Nitrogen'], 16=>$value['Median Blood Urea Nitrogen'],
                17=>$value['Min Anion Gap'], 18=>$value['Max Anion Gap'],
                19=>$value['Mean Anion Gap'], 20=>$value['Median Anion Gap'],
                21=>$value['Min Heart Rate'], 22=>$value['Max Heart Rate'],
                23=>$value['Mean Heart Rate'], 24=>$value['Median Heart Rate'],
                25=>$value['Min Mean Arterial Pressure'], 26=>$value['Max Mean Arterial Pressure'],
                27=>$value['Mean Mean Arterial Pressure'], 28=>$value['Median Mean Arterial Pressure'],
                29=>$value['Min Respiratory Rate'], 30=>$value['Max Respiratory Rate'],
                31=>$value['Mean Respiratory Rate'], 32=>$value['Median Respiratory Rate'],
                33=>$value['Min Temperature'], 34=>$value['Max Temperature'],
                35=>$value['Mean Temperature'], 36=>$value['Median Temperature']
            );
        }
        return $result;
    }

    public static function getPostParams() {
        $db = new Database();
        $q = "SELECT * FROM `adss`.`normalized_cases` order by `id` ASC";
        $results = $db->createQuery($q);
        $i = 1;
        $result = array();
        foreach($results as $key=>$value) {
            $result[$value['id']] = array(0=>$value['id']);
            while(isset($_POST['param_'.$i])) {
                $result[$value['id']][$i] = $value[$_POST['param_' . $i]];
                $i++;
            }
            $i = 1;
            /* All Parameters
                1=>$value['Min Creatinine'], 2=>$value['Max Creatinine'],
                3=>$value['Mean Creatinine'], 4=>$value['Median Creatinine'],
                5=>$value['Min Bilirubin'], 6=>$value['Max Bilirubin'],
                7=>$value['Mean Bilirubin'], 8=>$value['Median Bilirubin'],
                9=>$value['Min Platelets'], 10=>$value['Mean Platelets'],
                11=>$value['Max Platelets'], 12=>$value['Median Platelets'],
                13=>$value['Min Blood Urea Nitrogen'], 14=>$value['Max Blood Urea Nitrogen'],
                15=>$value['Mean Blood Urea Nitrogen'], 16=>$value['Median Blood Urea Nitrogen'],
                17=>$value['Min Anion Gap'], 18=>$value['Max Anion Gap'],
                19=>$value['Mean Anion Gap'], 20=>$value['Median Anion Gap']);*/
        }
        return $result;
    }

    public static function KNN_Algorithm($filename, $id, $num_of_neighbors) {
        // Read the csv file that contains patients parameters
        $data = array();
        $file = fopen($filename, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $data[$line[0]] = $line;
        }
        fclose($file);
        unset($data[0]); // Remove params header (i.e: age,id,bp...)

        // Build distance matrix
        $distances = array();
        $distances[$id] = SimilarCases::euclideanDistance($data[$id], $id, $data);
        // Example, target = id 1, getting 10 nearest neighbors
        $neighbors = SimilarCases::getNearestNeighbors($distances, $id, $num_of_neighbors);
        return $neighbors;
    }

    /**
     * Calculates eucilean distances for an array dataset
     *
     * @param array $sourceCoords In format array(x, y, ...)
     * @param array $sourceKey Associated array key
     * @param array $data
     * @return array Of distances to the rest of the data set
     */
    static function euclideanDistance($sourceCoords, $sourceKey, $data)
    {
        $distances = array();
        $params_size = sizeof($sourceCoords)-1;
        for($i = 1; $i <= $params_size; $i++) {
            ${'x'.$i} = $sourceCoords[$i];
        }
        foreach ($data as $destinationKey => $destinationCoords) {
            // Same point, ignore
            if ($sourceKey == $destinationKey) {
                continue;
            }
            $sum = 0;
            for($i = 1; $i <= $params_size; $i++) {
                ${'y'.$i} = $destinationCoords[$i];
                $sum += (pow((${'x'.$i} - ${'y'.$i}), 2));
            }
            $distances[$destinationKey] = sqrt($sum);
        }
        asort($distances);
        $sourceCoords = $distances;
        return $sourceCoords;
    }

    /**
     * Returns n-nearest neighbors
     *
     * @param array $distances Distances generated above ^
     * @param mixed $key Array key of source location
     * @param int $num Of neighbors to fetch
     * @return array Of nearest neighbors
     */
    static function getNearestNeighbors($distances, $key, $num)
    {
        return array_slice($distances[$key], 0, $num, true);
    }

}