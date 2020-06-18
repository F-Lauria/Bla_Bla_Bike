<?php

session_start();
require ("./connection.php");
include_once ("./file.php");



$Titolo=$_GET["titolo"];

$Prezzo=$_GET["prezzo"];
$Descrizione=$_GET["descrizione"];
$Stato=$_GET["stato"];
$BiciAnnuncio= $_SESSION["BiciAnnuncio"];

$DataVendita="";

$Venditore=RecuperaID($cid,$_SESSION['Nome']);
//echo "Venditore:$Venditore<br>";

$ID_Annuncio=RecuperaMaxID_Annuncio($cid);

$ID_Annuncio++;
//echo "Annuncio: $ID_Annuncio";

$risultato=InserisciAnnuncio($cid,$ID_Annuncio, $Venditore, $BiciAnnuncio, $Titolo,$Prezzo,
                                      $Descrizione,$Stato,$DataVendita); // l'inserimento non va nel DB



if ($risultato["status"]==1){
  $_SESSION["Utente"]=true;
  header("location: ../index.php?op=TuoiAnnunci");
}
else{
  $msg=  $risultato["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}

 ?>
