<?php

$hostname= "localhost";
$username="root";
$password="";
$db="Bla_bla_bike";

$cid = new mysqli($hostname,$username,$password,$db);

if ($cid->connect_errno)
{
   die('Errore di connessione ('
       . $cid->connect_errno . ')' . $cid->connect_error);
}

//echo "connesso <br/>";

?>
