<?php



session_start();
include_once("./connection.php");
include_once ("./file.php");

$Marca='';
if(isset($_GET["Marche"]))
echo  $Marca=$_GET["Marche"];
else echo $Marca=$_GET["Altro"];

echo $Colore=$_GET["Colore"];
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

$BiciDaModificare=$_GET["BiciDaModificare"];


$risultato=ModificaBicicletta($cid,$BiciDaModificare,$Marca, $Colore,$AnnoProduzione,$AnnoAcquisto,$TipoBicicletta,$Peso,$DimensioneRuote);

?>
