<?php

session_start();


include_once("./connection.php");
include_once ("./file.php");



echo $DurataMax=$_GET["DurataMax"];
echo $LivelloDifficolta=$_GET["LivelloDifficoltà"];
echo $TipoUscita=$_GET["TipoUscita"];
echo $Luogo=$_GET["Luogo"];
echo $IdFiltro=$_GET["FiltroUscitaDaModificare"];

$risultato=ModificaFiltroUscita($cid,$DurataMax,$LivelloDifficolta,$TipoUscita,$Luogo,$IdFiltro);




 ?>
