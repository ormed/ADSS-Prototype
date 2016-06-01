<?php
include_once "database/Sepsis.php";

$patientId = $_GET['patientId'];
$result = Sepsis::getTemperatureById($patientId);

$rows = array();
$table = array();
$table['cols'] = array(
    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Time', 'type' => 'number'),
    array('label' => 'Temperature', 'type' => 'number'),
);
$rows = array();

foreach($result as $tr) {
    $temp = array();
    foreach($tr as $key=>$value){
        // Values of each slice
        $temp[] = array('v' => $value);
    }
    $rows[] = array('c' => $temp);
}
$table['rows'] = $rows;

$jsonTemperature = json_encode($table);
echo $jsonTemperature;
