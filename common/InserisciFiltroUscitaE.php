<?php

session_start();


include_once("./connection.php");
include_once ("./file.php");



echo $Utente=$_SESSION["UtenteFiltro"];
echo $DurataMax=$_GET["DurataMax"];
echo $LivelloDifficolta=$_GET["LivelloDifficoltà"];
echo $TipoUscita=$_GET["TipoUscita"];
echo $Luogo=$_GET["Luogo"];

$MaxIdFiltroAnnuncio=RecuperaMaxIDFiltroAnnuncio($cid);

$MaxIdFiltroUscita=RecuperaMaxIdFiltroUscita($cid);



if($MaxIdFiltroAnnuncio==0 && $MaxIdFiltroUscita==0)
echo  $ID_Filtro=1;

else {
  if($MaxIdFiltroUscita>$MaxIdFiltroAnnuncio)
    echo $ID_Filtro=$MaxIdFiltroUscita+1;
  else
    echo $ID_Filtro=$MaxIdFiltroAnnuncio+1;
}


$risultatoFiltroUscita=InserisciFiltroUscita($cid,$ID_Filtro,$Utente,$DurataMax,$LivelloDifficolta,$TipoUscita,$Luogo);


  if ($risultatoFiltroUscita["status"]==1){
    $_SESSION["Utente"]=true;
    header("location: ../index.php?op=Profilo");
  }
  else{
    $msg=  $risultatoFiltroUscita["msg"];
    $msg= base64_encode($msg);
    header("location: ../index.php?op=msg&msg=$msg");
  }









 ?>
