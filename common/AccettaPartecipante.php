<?php
session_start();


include_once("./connection.php");
include_once ("./file.php");

$ID_Utente=$_GET['Utente'];
$ID_Uscita=$_GET['Uscita'];
$ID_Bike=$_GET['Bike'];

AccettaPartecipante($cid,$ID_Utente, $ID_Uscita,$ID_Bike );

 ?>
