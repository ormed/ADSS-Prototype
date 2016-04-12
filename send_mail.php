<?php
include_once 'help_functions.php';
include_once 'database/Database.php';
/*$to       = 'ormed1994@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: mikitahat2@gmail.com' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";*/


$db = new Database();
$q = 'SELECT a.Value, b.Value FROM anion_gap a, bun b where a.id=b.rand.id';
$result = $db->createQuery($q);
debug($result);
//"SELECT c.c_name, c.logo, c.email, l.id, l.title, l.type,l.budget,l.deadline,l.job_desc,l.c_id, l.time, l.vote_up from c_profile c,listing l where c.c_uid=l.c_id";