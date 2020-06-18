<?php
session_start();

include_once("./connection.php");
include_once ("./file.php");

$Nome_Utente=$_POST["Nome_Utente"];
$pwd=$_POST["pwd"];

if (accedi($cid,$Nome_Utente,$pwd))
{
	$_SESSION['Nome']= $Nome_Utente;
	$_SESSION["Utente"]=true;
  header("location: ../index.php");


}
else
{
	session_destroy();
  header("location: ../index.php?op=Iscriviti");
}
 ?>
