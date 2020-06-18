<?php
session_start();


include_once("./connection.php");
include_once ("./file.php");


echo $Utente=$_SESSION["UtenteFiltro"];
echo $Marca=$_GET["Marche"];
echo $Colore=$_GET["Colore"];
echo $Prezzo=$_GET["Prezzo"];
 //$ID_Filtro='';



$MaxIdFiltroAnnuncio=RecuperaMaxIDFiltroAnnuncio($cid);

 $MaxIdFiltroUscita=RecuperaMaxIdFiltroUscita($cid);



if($MaxIdFiltroAnnuncio==0 && $MaxIdFiltroUscita==0)
echo  $ID_Filtro=1;

else {
  if($MaxIdFiltroAnnuncio>$MaxIdFiltroUscita)
    echo $ID_Filtro=$MaxIdFiltroAnnuncio+1;
  else
    echo $ID_Filtro=$MaxIdFiltroUscita+1;
}


$risultatoFiltroAnnuncio=InserisciFiltroAnnuncio($cid,$ID_Filtro,$Utente,$Marca,$Colore,$Prezzo);


  if ($risultatoFiltroAnnuncio["status"]==1){
    $_SESSION["Utente"]=true;
    header("location: ../index.php?op=Profilo");
  }
  else{
    $msg=  $risultatoFiltroAnnuncio["msg"];
    $msg= base64_encode($msg);
    header("location: ../index.php?op=msg&msg=$msg");
  }


 ?>
