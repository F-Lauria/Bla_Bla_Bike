<?php
session_start();


include_once("./connection.php");
include_once ("./file.php");


$Nome=$_POST['name'];
$Cognome=$_POST['cognome'];
$DataN=$_POST['dataN'];
$LuogoN=$_POST['luogoN'];
$Città=$_POST['citta'];
$Email=$_POST["e-mail"];
$Sesso='';
if(isset($_POST['sesso']))
  $Sesso=$_POST['sesso'];

$Tipo_Profilo=$_POST['Tipo_Profilo'];



echo "$Nome<br/>$Cognome<br/>$DataN<br/>$LuogoN<br/>$Città<br/>$Sesso</br>$Tipo_Profilo";


$ID_Utente= RecuperaID($cid, $_SESSION['Nome']);
echo $ID_Utente;


$Nfollowers=0;


$risultato=InserisciProfilo($cid,$ID_Utente, $Nome, $Cognome, $DataN,$LuogoN, $Città,$Email,$Sesso,$Nfollowers,$Tipo_Profilo  );



if ($risultato["status"]==1){
  $_SESSION["Utente"]=true;
  header("location: ../index.php?op=Profilo&Profilo=Profilo");
}
else{
  $msg=  $risultato["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
 ?>
