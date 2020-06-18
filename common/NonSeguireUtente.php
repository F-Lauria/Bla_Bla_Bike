<?php
session_start();
include_once('./connection.php');
include_once('./file.php');

$Pagina=$_GET['tpp'];
$Seguito= $_POST['IDCiclistaSeguito'];
$Seguace= $_SESSION['MioIdCiclista'];

$risultatoElimina = EliminaSegui($cid,$Seguace,$Seguito);


if ($risultatoElimina["status"]==1){
  $_SESSION["Utente"]=true;
}
else{
  $msg=  $risultatoElimina["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
 $NumFollowers= RecuperaNumFollowers($cid,$Seguito)."<br>";
 $NumFollowers=$NumFollowers-1;

$risultatoInserisciFollowers=InserisciNumFollowers($cid,$Seguito,$NumFollowers);

if($risultatoInserisciFollowers['status']==0){
  $msg= $risultatoInserisciFollowers["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
else {
  if($_GET['op']=='seguiAmici')
    header("location: ../index.php?op=Profilo");
  else
    header("location: ../index.php?op=Ciclisti&page=$Pagina");
}


?>
