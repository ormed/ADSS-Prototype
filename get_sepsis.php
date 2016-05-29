<?php
include_once "database/Sepsis.php";

$result = Sepsis::getBicarbonateById(1);
// set heading
$data[0] = array('Time','Bicarbonate');
$size = count($result);
for ($i=1; $i<=$size; $i++)
{
    $data[$i] = array($result[$i-1]['Time'], $result[$i-1]['Bicarbonate']);
}
echo json_encode($data);
