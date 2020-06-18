<?php

session_start();
include_once("./connection.php");
include_once ("./file.php");



$ID_Uscita=RecuperaMaxID_Uscite($cid);
$ID_Uscita++;
echo $ID_Uscita;

$Organizzatore=RecuperaID($cid,$_SESSION['Nome']);
echo $Organizzatore;

echo $Titolo=$_GET["titolo"];
echo $Tipo_Uscita=$_GET["TipoUscita"];
echo $Livello_Difficoltà=$_GET["LivelloDifficoltà"];
echo $Livello_Visibilità=$_GET["LivelloVisibilità"];
echo $Durata=$_GET["Durata"];
if ($_GET["Distanza"]==0)
  $Distanza='0';
else $Distanza=$_GET["Distanza"];

if ($_GET["Dislivello"]==0)
  $Dislivello='0';
else $Dislivello=$_GET["Dislivello"];

echo $Ora=$_GET["Ora"];
echo $Data=$_GET["Data"];
echo $Luogo=$_GET["Luogo"];
echo $Valutazione=null;
echo $Note=$_GET["Note"];

$risultatoUscita=InserisciUscita($cid,$ID_Uscita,$Organizzatore,$Titolo,$Tipo_Uscita,$Livello_Difficoltà,$Livello_Visibilità,
                                    $Durata,$Distanza,$Dislivello,$Ora,$Data,$Luogo,$Valutazione,$Note);


if ($risultatoUscita["status"]==1){
  $_SESSION["Utente"]=true;
  $_SESSION["TitoloUscita"]=$Titolo;// salvo il nome dell'uscita
  $_SESSION["LunghezzaUscita"]=$Distanza; // salvo la lunghezza dell'uscita per confrontarla con quella delle tappe
  $_SESSION["ID_Uscita"]=$ID_Uscita; // salvo l'ID dell'uscita in questo modo le tappe vengono inserite in questa uscita

  header("location: ../index.php?op=InserisciTappe&");
}
else{
  $msg=  $risultatoUscita["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}


 ?>
