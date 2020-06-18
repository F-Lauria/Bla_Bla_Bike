<?php

session_start();
include_once("./connection.php");
include_once ("./file.php");

echo $Marca=$_GET["Marche"];
echo $Colore=$_GET["Colore"];
echo $Prezzo=$_GET["Prezzo"];
 echo $ID_Filtro=$_GET["FiltroAnnuncioDaModificare"];

 $risultato=ModificaFiltroAnnuncio($cid,$Marca,$Colore,$Prezzo,$ID_Filtro);


 ?>
