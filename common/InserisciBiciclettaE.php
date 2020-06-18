<?php

session_start();
include_once("./connection.php");
include_once ("./file.php");

$Marca='';
if(isset($_GET["Marche"]))
  $Marca=$_GET["Marche"];
else $Marca=$_GET["Altro"];

$Colore=$_GET["Colore"];
$AnnoProduzione=$_GET["AnnoProduzione"];
echo $AnnoProduzione;
$AnnoAcquisto=$_GET["AnnoAcquisto"];
echo $AnnoAcquisto;
$TipoBicicletta=$_GET["TipoBicicletta"];
echo $TipoBicicletta;
$DimensioneRuote='';

$Peso='';
if($TipoBicicletta=='corsa'){
$Peso=$_GET["Peso"];

echo $Peso;}

if($TipoBicicletta=='mountain bike'){
$DimensioneRuote=$_GET["DimensioneRuote"];
echo $DimensioneRuote;}



$Proprietario=RecuperaID($cid,$_SESSION['Nome']);
echo $Proprietario;


$ID_Bike=RecuperaMaxID_Bike($cid);

echo $ID_Bike;
$ID_Bike++;

$risultatoBicicletta=InserisciBicicletta($cid,$ID_Bike, $Proprietario, $Marca, $Colore,$AnnoProduzione,
                                          $AnnoAcquisto,$TipoBicicletta,$Peso,$DimensioneRuote);


if ($risultatoBicicletta["status"]==1){
  $_SESSION["Utente"]=true;
  header("location: ../index.php?op=Profilo");
}
else{
  $msg=  $risultatoBicicletta["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}


 ?>
