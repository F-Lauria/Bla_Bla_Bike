<?php
session_start();

include_once("./connection.php");
include_once ("./file.php");


$Nome_Utente=$_POST["username"];

$pwd=$_POST["pwd"];
$pwd1=$_POST["pwd1"];

	$_SESSION['Nome']= $Nome_Utente;

if($pwd==$pwd1)
  $pwd2=$pwd;
else
  echo "password sbagliata";


$ID_Utente=RecuperaMaxID($cid);
$ID_Utente++;
echo $ID_Utente;




$risultato= InserisciUtente($cid,$ID_Utente, $Nome_Utente, $pwd2 );



if ($risultato["status"]==1)
  header("location: ../index.php?op=InserisciProfilo&InserisciProfilo=InserisciProfilo");
else {
  $msg=  $risultato["msg"];

  $msg= base64_encode($msg);
header("location: ../index.php?op=msg&msg=$msg");
}


?>
