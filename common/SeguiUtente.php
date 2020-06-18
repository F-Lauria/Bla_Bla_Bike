<?php
session_start();
include_once('./connection.php');
include_once('./file.php');

$Pagina=$_GET['tpp'];//serve per la visualizzazione della pagina corrente al momento del reinvio

$Seguito= $_POST['IDCiclistaSeguito'];
$Seguace= $_SESSION['MioIdCiclista'];
$data= date('Y-m-d');

$risultatoSegui = SeguiUtente($cid,$Seguace, $Seguito,$data);


if ($risultatoSegui["status"]==1){
  $_SESSION["Utente"]=true;
}
else{
  $msg=  $risultatoSegui["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
 $NumFollowers= RecuperaNumFollowers($cid,$Seguito)."<br>";
 $NumFollowers=$NumFollowers+1;

$risultatoInserisciFollowers=InserisciNumFollowers($cid,$Seguito,$NumFollowers);

if($risultatoInserisciFollowers['status']==0){
  $msg= $risultatoInserisciFollowers["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
else header("location: ../index.php?op=Ciclisti&page=$Pagina");



?>
