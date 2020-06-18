<?php


session_start();


include_once("./connection.php");
include_once ("./file.php");


echo $Nome=$_POST['nome'];
$Cognome=$_POST['cognome'];
$DataN=$_POST['Data_Nascita'];
$LuogoN=$_POST['Luogo_Nascita'];
$Email=$_POST['Email'];
$Città=$_POST['Citta'];
$Sesso='';
if(isset($_POST['sesso']))
  echo $Sesso=$_POST['sesso'];

echo $Tipo_Profilo=$_POST['Tipo_Profilo'];




$ID_Utente= RecuperaID($cid, $_SESSION['Nome']);

$risultato=ModificaProfilo($cid,$ID_Utente,$Nome,$Cognome,$DataN,$LuogoN,$Città,$Email,$Sesso,$Tipo_Profilo);




 ?>
