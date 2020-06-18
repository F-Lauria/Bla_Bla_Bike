<?php

session_start();

include_once("./connection.php");
include_once ("./file.php");

$ID_Uscita = $_SESSION["ID_Uscita"];
$Num_Progressivo=RecuperaMaxNumeroProgressivo_Uscite($cid,$ID_Uscita);
if(empty($Num_Progressivo))
  $Num_Progressivo=1;
else $Num_Progressivo ++;


$LunghezzaTappa= $_GET['Lunghezza'];

$TipoTappa= $_GET['Tipo_Tappa'];

$sommaTappe=RecuperaSommaLunghezzaTappe($cid,$ID_Uscita);

echo "sommatappe $sommaTappe <br>";

$LunghezzaUscita=RecuperaLunghezzaUscita($cid,$ID_Uscita);
echo "Luscita $LunghezzaUscita";
if(($sommaTappe+$LunghezzaTappa)>$LunghezzaUscita){
  header("location: ../index.php?op=InserisciTappe&bkk=Not&tpp=$LunghezzaUscita");
}
else{
$risultatoTappa=InserisciTappa($cid,$Num_Progressivo,$ID_Uscita,$LunghezzaTappa,$TipoTappa);


if ($risultatoTappa["status"]==1){
  $_SESSION["Utente"]=true;
  header("location: ../index.php?op=InserisciTappe");

}
else{
  $msg=  $risultatoTappa["msg"];
  $msg= base64_encode($msg);
  header("location: ../index.php?op=msg&msg=$msg");
}
}





?>
