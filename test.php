<?php
include_once('pages/functions.php');
$link = mysqli_connect('localhost','test','123456',' fitness_db');

$sel = mysqli_query($link, 'SELECT * FROM users');

while($row = mysqli_fetch_array($sel))
{
   echo $row['id']. ' '. $row['first_name']. ' ' . $row['last_name']. '</br>';
}

var_dump(connect());
?>