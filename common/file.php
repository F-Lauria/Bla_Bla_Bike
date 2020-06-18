<?php

require "connection.php";

function EliminaProfilo($cid,$ProfiloDaEliminare){

  $sql="DELETE FROM Utente WHERE ID_Utente='$ProfiloDaEliminare'";

  $res = $cid->query($sql)
    or die("Impossibile eseguire cencellazione! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");

    session_destroy();
    header("location: ./index.php");


}



function EliminaAnnuncio($cid,$AnnuncioDaEliminare){

  $sql="DELETE FROM Annuncio WHERE ID_Annuncio='$AnnuncioDaEliminare'";
  $res = $cid->query($sql)
    or die("Impossibile eseguire cencellazione! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");

    header("location: ./index.php?op=TuoiAnnunci");


}

function ModificaFiltroUscita($cid,$DurataMax,$LivelloDifficolta,$TipoUscita,$Luogo,$IdFiltro){

$sql="UPDATE FiltroUscita SET Durata= '$DurataMax' ,Livello_di_difficolta='$LivelloDifficolta', Tipo_Uscita='$TipoUscita',Luogo='$Luogo' WHERE ID_FiltroUscita=$IdFiltro";
$res = $cid->query($sql)
  or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
$modifica = 1; // notifica la riuscita dalla modifica

  if($modifica)
    header("location: ../index.php?op=Profilo");


}


function InserisciFiltroUscita($cid,$ID_Filtro,$Utente,$DurataMax,$LivelloDifficolta,$TipoUscita,$Luogo){

  $risultato=array("msg" => "", "status" => 1);
  $msg="";
  $errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
  if (empty($ID_Filtro) || empty($Utente) || empty($DurataMax) || empty($LivelloDifficolta) || empty($TipoUscita) || empty($Luogo))
     $errore="Non hai inserito i campi obbligatori;";

  if (!empty($errore))
  {
    $msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
    $risultato["status"]=0;
  }
  else{

  $sql="INSERT into FiltroUscita values ('$ID_Filtro','$Utente','$DurataMax','$LivelloDifficolta','$TipoUscita','$Luogo')";

  $res=$cid->query($sql);
  if ($res->affected_rows==1)
  {
    $msg= "<div class=\"errore\">  Non posso inserire questo annuncio </div>";
      $risultato["status"]=0;

  }
  }
  $risultato["msg"]=$msg;
  return $risultato;

  $risultato["msg"]=$msg;
  return $risultato;
  }




function ModificaFiltroAnnuncio($cid,$Marca,$Colore,$Prezzo,$ID_Filtro){

$sql="UPDATE FiltroAnnuncio SET Marca= '$Marca' ,Colore='$Colore', Prezzo='$Prezzo' WHERE ID_FiltroAnnuncio=$ID_Filtro";
$res = $cid->query($sql)
  or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
$modifica = 1; // notifica la riuscita dalla modifica

  if($modifica)
    header("location: ../index.php?op=Profilo");


}


function InserisciFiltroAnnuncio($cid,$ID_Filtro,$Utente,$Marca,$Colore,$Prezzo){

  $risultato=array("msg" => "", "status" => 1);
  $msg="";
  $errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
  if (empty($ID_Filtro) || empty($Utente) || empty($Marca) || empty($Colore) || empty($Prezzo))
     $errore="Non hai inserito i campi obbligatori;";

  if (!empty($errore))
  {
    $msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
    $risultato["status"]=0;
  }
  else{

  $sql="INSERT into FiltroAnnuncio values ('$ID_Filtro','$Utente','$Marca','$Colore','$Prezzo')";

  $res=$cid->query($sql);
  if ($res->affected_rows==1)
  {
    $msg= "<div class=\"errore\">  Non posso inserire questo annuncio </div>";
      $risultato["status"]=0;

  }
  }
  $risultato["msg"]=$msg;
  return $risultato;

  $risultato["msg"]=$msg;
  return $risultato;
  }







function RecuperaMaxIDFiltroAnnuncio($cid){

$sql="SELECT max(ID_FiltroAnnuncio) FROM FiltroAnnuncio";

$res=$cid->query($sql) or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";
if ($res){
  if ($res->num_rows==0)
    return false;
  else {
    while($row=$res->fetch_row()){
      return $row[0];
    }
  }
return false;
}
}


function RecuperaMaxIdFiltroUscita($cid){

$sql="SELECT max(ID_FiltroUscita) FROM FiltroUscita";
$res=$cid->query($sql) or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";
if ($res){
  if ($res->num_rows==0)
    return false;
  else {
    while($row=$res->fetch_row()){
      return $row[0];
    }
  }
return false;
}
}


function VisualizzaFiltri($cid,$ID){

  $sql="SELECT Durata,Livello_di_difficolta,Tipo_Uscita,Luogo,ID_FiltroUscita FROM FiltroUscita WHERE Utente='$ID'";

  $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";

  if ($res->num_rows==0)
  echo "<table align='center'><td><a href='./index.php?op=Profilo&bkk=FiltroUscita'  class=\"shiny-button\" >Inserisci un filtro per le uscite</a></td></table> </br>";
else {
  echo "<table align='center' class='bordi'>
           <tr><th> Durata massima </th><th> Livello di difficolta </th><th> Tipo di uscita </th><th>Luogo</th> <th></th></tr> ";

  while($row=$res->fetch_row()){

    echo '<tr>';

     echo " <td> $row[0]</td>";
     echo " <td> $row[1]</td>";
     echo " <td>  $row[2]</td>";
     echo " <td>  $row[3]</td>";
     echo "<td><a href='index.php?op=Profilo&bk=ModificaFiltroUscita&oppa=$row[4]'  class=\"shiny-button\"> Modifica </a></td>";
     echo "</tr>";
  }
  Unset($res);
  echo "</table>";

}

echo "<br>";


  $sql2="SELECT Marca,Colore,Prezzo,ID_FiltroAnnuncio FROM FiltroAnnuncio WHERE Utente='$ID'";

  $res2=$cid->query($sql2) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";

  if ($res2->num_rows==0)
   echo "<table align='center'><td><a href='./index.php?op=Profilo&bkk=FiltroAnnuncio'  class=\"shiny-button\">Inserisci un filtro per gli annunci</a></td></table> </br>";
else {
  echo "<table align='center' class='bordi'>
           <tr><th> Marca </th><th> Colore </th> <th> Prezzo massimo </th><th></th></tr> ";

  while($row2=$res2->fetch_row()){

    echo '<tr>';

     echo " <td> $row2[0]</td>";
     echo " <td> $row2[1]</td>";
     echo " <td>  $row2[2]</td>";
     echo "<td><a href='index.php?op=Profilo&bk=ModificaFiltroAnnuncio&oppa=$row2[3]'  class=\"shiny-button\"> Modifica </a></td>";
     echo "</tr>";
  }
  Unset($res2);
  echo "</table>";


}

}

function VisualizzaContattoVenditore($cid,$Venditore){
  $sql="SELECT Nome,Cognome,Citta,E_mail FROM Profilo where ID_Utente=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$Venditore')";

  $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";

  echo "<table align='center' class='inside'>
           <tr><th> Nome </th><th> Cognome </th><th> Città </th> <th> E-mail </th></tr> ";
  while($row=$res->fetch_row()){

    echo '<tr>';

     echo " <td> $row[0]</td>";
     echo " <td> $row[1]</td>";
     echo " <td>  $row[2]</td>";
     echo " <td> $row[3]</td>";
       //echo "<td><a href=\"index.php?op=Modifica&bk=ModificaProfilo&tpp=$row[0]\" class=\"Modifica active\">Modifica</a></td>";
     echo "</tr>";
  }
  Unset($res);
  echo "</table>";
}

function VisualizzaAnnuncioSelezionato($cid,$Annuncio){

$sql="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato,Venditore,ID_Annuncio FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE ID_Annuncio='$Annuncio' ";

$res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
 echo "<table align='center' ><td>Selezione errata.</td></table> </br>";
else{
 echo "<table align='center' class='bordi'>";
 echo "<tr><th>Titolo annuncio</th><th>Marca</th><th>Colore</th><th>Anno di Produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Prezzo</th><th>Descrizione</th><th>Stato</th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>$row[0]</td>";
echo "<td>$row[1]</td>";
echo "<td>$row[2]</td>";
echo "<td>$row[3]</td>";
echo "<td>$row[4]</td>";
echo "<td>$row[5]</td>";
echo "<td>$row[6]</td>";
echo "<td>$row[7]</td>";
echo "<td>$row[8]</td>";
//echo "<td><a href='./index.php?op=Mercatino&bk=VisualizzaMercatino&bkk=$row[9]&opann=$row[10]'>Visualizza</a></td>";
echo "</tr>";
}

echo "</table>";

}


function VisualizzaMercatino($cid){
  $pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato,Venditore,ID_Annuncio FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE Stato='In vendita'
  LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non sono stati ancora pubblicati annunci.</td></table> </br>";
	else{
		echo "<table align='center' class='inside'>";
		echo "<tr><th>Titolo annuncio</th><th>Marca</th><th>Colore</th><th>Anno di Produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Prezzo</th><th>Descrizione</th><th>Stato</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
  echo "<td>$row[4]</td>";
  echo "<td>$row[5]</td>";
  echo "<td>$row[6]</td>";
  echo "<td>$row[7]</td>";
  echo "<td>$row[8]</td>";
  echo "<td><a href='./index.php?op=Mercatino&bk=VisualizzaMercatino&bkk=$row[9]&opann=$row[10]'  class=\"shiny-button\">Visualizza</a></td>";


	echo "</tr>";
	}
	echo "<tr><td colspan='12'>";

	$sql2="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE Stato='In vendita'";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Mercatino&bk=VisualizzaMercatino'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit" class="shiny-button"  value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Mercatino&bk=VisualizzaMercatino">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';
}






function VisualizzaAnnunciDaTePubblicati($cid,$ID){



  $pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato,ID_Annuncio,Data_Vendita FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE Venditore='$ID'
  LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center'  ><td>Non hai ancora pubblicato annunci.</td></table> </br>";
	else{
		echo "<table align='center'class='bordi'>";
		echo "<tr><th>Titolo annuncio</th><th>Marca</th><th>Colore</th><th>Anno di Produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Prezzo</th><th>Descrizione</th><th>Stato</th><th>Data di vendita</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
  echo "<td>$row[4]</td>";
  echo "<td>$row[5]</td>";
  echo "<td>$row[6]</td>";
  echo "<td>$row[7]</td>";
  echo "<td>$row[8]</td>";
  echo "<td>$row[10]</td>";
  if($row[8]=="In vendita")
  echo "<td><a href='./index.php?op=Modifica&bk=ModificaStato&opann=$row[9]&bkk=$row[8]' onclick=\"return ConfermaVenditaAnnuncio()\"  class=\"shiny-button\">Vendi</a></td>";
  echo "<td><a href='./index.php?op=TuoiAnnunci&opann=$row[9]' onclick=\"return ConfermaEliminaAnnuncio()\"  class=\"shiny-button2\">Elimina annuncio</a></td>";




	echo "</tr>";
	}
	echo "<tr><td colspan='12'>";

	$sql2="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE Venditore='$ID'";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=TuoiAnnunci'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit" class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=TuoiAnnunci">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';
}


function VisualizzaUscitaSelezionata($cid,$ID_Uscita,$TitoloUscita){


$sql="SELECT ID_Uscita,Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Data, Luogo, Valutazione, Note, Nome_Utente
 FROM Uscita INNER JOIN Utente ON(Organizzatore=ID_Utente) WHERE ID_Uscita='$ID_Uscita' ";

$res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
 echo "<table align='center' ><td>Non hai ancora pubblicato uscite.</td></table> </br>";
else{
  echo "<h1><i>L'Uscita: </i>".strtoupper($TitoloUscita)."</h1>";
  echo "<table align='center'>";

  echo "<tr><th>Organizzatore</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th>Valutazione</th><th>Note</th><th></th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>".strtoupper($row[13])."</td>";
echo "<td>$row[2]</td>";
$_SESSION['TipoUscita']=$row[2];
echo "<td>$row[3]</td>";
echo "<td>$row[4]</td>";
echo "<td>$row[5] ore</td>";
echo "<td>$row[6] km</td>";
echo "<td>$row[7] m</td>";
echo "<td>$row[8]</td>";
echo "<td>$row[9]</td>";
echo "<td>$row[10]</td>";
echo "<td>$row[11]</td>";
echo "<td>$row[12]</td>";
echo "</tr>";
}

echo "</table>";




}





function RimuoviUscita($cid,$UscitaDaRimuovere){

	$sql="DELETE FROM Uscita WHERE ID_Uscita='$UscitaDaRimuovere'";

	$res=$cid->query($sql);

	header("location: index.php?op=TueUscite");

}

function EliminaBicicletta($cid,$BiciDaEliminare){

	$sql="DELETE FROM `Bicicletta` WHERE ID_Bike='$BiciDaEliminare'";

	$res=$cid->query($sql);

	header("location: index.php?op=Profilo");



}


function RestituisciNome_Utente($cid,$ID){
	$sql= "SELECT Nome_Utente FROM Utente
	 WHERE ID_Utente=$ID";
	$res= $cid->query($sql) or die();
	if ($res)
		if ($res->num_rows==0)
			return false;
	else {

  	while($row=$res->fetch_row()){
		 	return $row[0];
		}
	}
return false;
}



function ModificaBicicletta($cid,$BiciDaModificare,$Marca, $Colore,$AnnoProduzione,$AnnoAcquisto,$TipoBicicletta,$Peso,$DimensioneRuote){

	$query="UPDATE Bicicletta SET Marca='$Marca',Colore='$Colore',Anno_Produzione='$AnnoProduzione',Anno_Acquisto='$AnnoAcquisto',Tipo_Bicicletta='$TipoBicicletta',Peso='$Peso',Dimensione_Ruote='$DimensioneRuote'
	WHERE ID_Bike='$BiciDaModificare'";
	$res = $cid->query($query)
		or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	$modifica = 1; // notifica la riuscita dalla modifica

		if($modifica)
			header("location: ../index.php?op=Profilo");

}



function ModificaProfilo($cid,$ID,$Nome,$Cognome,$DataN,$LuogoN,$Città,$Email,$Sesso,$Tipo_Profilo){

	$query = "UPDATE Profilo SET Nome='$Nome', Cognome='$Cognome', Data_Nascita='$DataN', Luogo_Nascita='$LuogoN', Citta='$Città', E_mail='$Email', Sesso='$Sesso',Tipo_Profilo='$Tipo_Profilo'
	WHERE ID_Utente=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID')";
	$res = $cid->query($query)
		or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	$modifica = 1; // notifica la riuscita dalla modifica

		if($modifica)
			header("location: ../index.php?op=Profilo");


}



function InserisciAnnuncio($cid,$ID_Annuncio,$Venditore,$Bicicletta,$Titolo,$Prezzo,$Descrizione,$Stato,$Data_Vendita){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($ID_Annuncio) || empty($Venditore) || empty($Bicicletta) || empty($Titolo) || empty($Prezzo) || empty($Stato))
		 $errore="Non hai inserito i campi obbligatori;";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else{
		$sql = "INSERT INTO Annuncio VALUES ('$ID_Annuncio','$Venditore','$Bicicletta','$Titolo','$Prezzo','$Descrizione','$Stato','$Data_Vendita');";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msg= "<div class=\"errore\">  Non posso inserire questo annuncio </div>";
		    $risultato["status"]=0;

		}
	}
	$risultato["msg"]=$msg;
	return $risultato;

$risultato["msg"]=$msg;
return $risultato;
}
function VisualizzaBiciclettaSelezionataPerUscita($cid, $ID_Bike){
	$sql="SELECT Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Peso,Dimensione_Ruote
	 FROM Bicicletta where ID_Bike='$ID_Bike'";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non possiedi ancora biciclette.</td></table> </br>";
	else{
		echo "<table align='center' class='bordi'>";
		echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5]</td>";
	echo "<td>$row[6]</td>";
	echo "</tr>";
	}
	Unset($res);
	echo "</table>";


}

function VisualizzaBiciclettePerUscita($cid,$ID_Utente,$ID_Uscita, $TitoloUscita, $Tipo){
	$pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

$sql="SELECT ID_Bike, Marca, Colore, Anno_Produzione, Anno_Acquisto, Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta where (Proprietario=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente') AND Tipo_Bicicletta='$Tipo')
 LIMIT $nrows OFFSET $offset";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
	echo "<p><i>Non possiedi biciclette adatte per questa uscita!</i></p></br>";
else{
	echo "<table align='center' class='bordi'>";
	echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th><th></th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>$row[1]</td>";
echo "<td>$row[2]</td>";
if ($row[3]!=0)
	echo "<td>$row[3]</td>";
else echo"<td></td>";

if ($row[4]!=0)
	echo "<td>$row[4]</td>";
else echo"<td></td>";

echo "<td>$row[5]</td>";


if ($row[6]!=0)
echo "<td>$row[6] kg </td>";
else echo "<td></td>";

if ($row[7]!=null)
echo "<td>$row[7] pollici</td>";
else echo "<td></td>";

echo "<td><a href='./index.php?op=Uscite&tpp=$ID_Uscita&opann=$TitoloUscita&bkk=$row[0]&oppa=BiciDaSelezionare'  class=\"shiny-button\">Seleziona</a></td>";

echo "</tr>";
}
echo "<tr><td colspan='9'>";

$sql2="SELECT ID_Bike, Marca, Colore, Anno_Produzione, Anno_Acquisto, Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta where (Proprietario=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente') AND Tipo_Bicicletta='$Tipo')";
 $res2 = $cid->query($sql2)
	 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
 $numrows = $res2->num_rows;
 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Uscite&tpp=$ID_Uscita&opann=$TitoloUscita&oppa=BiciDaSelezionare'>";
 if($pagina!=1) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
<?php

	 echo '<input type="submit" class="shiny-button" value="Precedente">';
 }
echo "</form></div>";
echo "<div style='float: right; width: 50%; text-align: left;'> <form style='float: left;' method='POST' action='./index.php?op=Uscite&tpp=$ID_Uscita&opann=$TitoloUscita&oppa=BiciDaSelezionare'>";
 if($pagina!=$paginaMax && $paginaMax!=0) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
<?php
	echo ' <input type="submit" class="shiny-button" value="Successivo">';
 }
echo "</form></div>";

 echo "</td></tr>";
 echo "</table>";
 echo '<br/><br/>';

}



function VisualizzaBiciclettePerAnnuncio($cid,$ID_Utente){
	$pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

$sql="SELECT ID_Bike, Marca, Colore, Anno_Produzione, Anno_Acquisto, Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta  where  Proprietario=$ID_Utente AND ID_Bike not in (SELECT Bicicletta from Annuncio)
 LIMIT $nrows OFFSET $offset";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0){
	echo "<table align='center'> <tr> <td>Non hai biciclette da vendere.</td></tr>";
  echo "<tr> <td> <a href='./index.php?op=Profilo&bk=bike' class=shiny-button2> Inserisci una bicicletta nel tuo profilo</a> </td> </tr></table> </br>";
}
else{
	echo "<table align='center' class='bordi'>";
	echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th><th></th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>$row[1]</td>";
echo "<td>$row[2]</td>";
if ($row[3]!=0)
	echo "<td>$row[3]</td>";
else echo"<td></td>";

if ($row[4]!=0)
	echo "<td>$row[4]</td>";
else echo"<td></td>";

echo "<td>$row[5]</td>";


if ($row[6]!=0)
echo "<td>$row[6] kg </td>";
else echo "<td></td>";

if ($row[7]!=null)
echo "<td>$row[7] pollici</td>";
else echo "<td></td>";

echo "<td><a href='index.php?op=TuoiAnnunci&bk=scelto&opann=$row[0]'  class=\"shiny-button\">Seleziona</a></td>";

echo "</tr>";
}
echo "<tr><td colspan='9'>";

$sql2="SELECT ID_Bike, Marca, Colore, Anno_Produzione, Anno_Acquisto, Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta  where  Proprietario=$ID_Utente AND ID_Bike not in (SELECT Bicicletta from Annuncio)";
 $res2 = $cid->query($sql2)
	 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
 $numrows = $res2->num_rows;
 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=TuoiAnnunci&bk=annunci'>";
 if($pagina!=1) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
<?php

	 echo '<input type="submit" class="shiny-button" value="Precedente">';
 }
echo "</form></div>";
echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=TuoiAnnunci&bk=annunci">';
 if($pagina!=$paginaMax && $paginaMax!=0) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
<?php
	echo ' <input type="submit" class="shiny-button" value="Successivo">';
 }
echo "</form></div>";

 echo "</td></tr>";
 echo "</table>";
 echo '<br/><br/>';

}


function  VisualizzaBiciclettaSelezionataPerAnnuncio($cid,$ID_Bike){
	$sql="SELECT Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Peso,Dimensione_Ruote
	 FROM Bicicletta where ID_Bike='$ID_Bike'";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non possiedi ancora biciclette.</td></table> </br>";
	else{
		echo "<table align='center' class='bordi'>";
		echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5]</td>";
	echo "<td>$row[6]</td>";
	echo "</tr>";
	}
	Unset($res);
	echo "</table>";

}


function RecuperaMaxID_Annuncio($cid){
	$sql= "SELECT max(ID_Annuncio)FROM Annuncio";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}





function accedi($cid,$Nome_utente,$pwd){
	$sql="SELECT * FROM Utente WHERE Nome_utente = '$Nome_utente' AND Password = '$pwd'";
	$res=$cid->query($sql) or die();
	if ($res)
	{	if ($res->num_rows==0)
		return false;
	else return true;
	}
	return false;
}



//RestituiciNome restiutisce
//il nome dell'utente con il fine di creare un pulsante personalizzato per andare sul profilo
function RestituisciNome($cid,$Nome_Utente){
	$sql= "SELECT Nome FROM Utente NATURAL JOIN Profilo
	 WHERE ID_Utente=(SELECT ID_Utente FROM Utente WHERE Nome_Utente= '$Nome_Utente')";
	$res= $cid->query($sql) or die();
	if ($res)
		if ($res->num_rows==0)
			return false;
	else {

  	while($row=$res->fetch_row()){
		 	return $row[0];
		}
	}
return false;

}





function InserisciUtente($cid,$ID_Utente,$Nome_Utente,$pwd){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($Nome_Utente) || empty($pwd) )
		 $errore="Nome utente e password devono essere specificati;";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else
	{
		$sql = "INSERT INTO utente VALUES ('$ID_Utente','$Nome_Utente','$pwd');";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msg= "<div class=\"errore\">  Non posso inserire questo utente </div>";
		    $risultato["status"]=0;

		}
	}
	$risultato["msg"]=$msg;
	return $risultato;

$risultato["msg"]=$msg;
return $risultato;
}





function RecuperaMaxID($cid){
	$sql= 'SELECT max(ID_Utente)FROM Utente';
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}


function RecuperaID($cid,$Nome_Utente){
	$sql= "SELECT ID_Utente FROM Utente WHERE Nome_Utente='$Nome_Utente'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}

function RecuperaValutazione($cid,$Uscita){
  $sql= "SELECT Valutazione FROM Uscita WHERE ID_Uscita='$Uscita'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}

}

function InserisciValutazione($cid,$Valutazione,$Uscita){
  $risultato=array("msg" => "", "status" => 1);
  $msg="";
  $errore="";

  if (empty($Uscita)){
     $errore="Non so in che uscita inserire la valutazione!";

  }


  if (!empty($errore))
  {
    $msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
    $risultato["status"]=0;
  }
  else
  {
    $sql = "UPDATE Uscita SET Valutazione=$Valutazione WHERE ID_Uscita=$Uscita";
    $res=$cid->query($sql);
    if ($res->affected_rows==1)
    {
      $msg= "<div class=\"errore\">  Non posso aggiornare il numero di followers </div>";
        $risultato["status"]=0;

    }
  }
  $risultato["msg"]=$msg;
  return $risultato;

}

function RecuperaNumNotifiche($cid,$ID){
  $sql= "SELECT * FROM Partecipanti NATURAL JOIN Uscita WHERE Organizzatore='$ID'AND Validita='NO'";
  $res=$cid->query($sql) or die();
  $num=$res->num_rows;
  return $num;

}



function RecuperaMaxNumeroProgressivo_Uscite($cid,$ID_Uscita){
	$sql= "SELECT MAX(Numero_Progressivo) FROM Tappa WHERE ID_Uscita='$ID_Uscita'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}

function RecuperaSommaLunghezzaTappe($cid,$ID_Uscita){
	$sql= "SELECT SUM(Lunghezza) FROM Tappa WHERE ID_Uscita='$ID_Uscita'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}

function RecuperaLunghezzaUscita($cid,$ID_Uscita){
	$sql= "SELECT Distanza FROM Uscita WHERE ID_Uscita='$ID_Uscita'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}


function VisualizzaBiciclette($cid,$ID_Utente){

$sql="SELECT Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Peso,Dimensione_Ruote, ID_Bike
 FROM Bicicletta where Proprietario=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente')";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
	echo "<table align='center' ><td>Non possiedi ancora biciclette.</td></table> </br>";
else{
	echo "<table align='center' class='bordi'>";
	echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>$row[0]</td>";
echo "<td>$row[1]</td>";

if ($row[2]!=0)
	echo "<td>$row[2]</td>";
else echo"<td></td>";

if ($row[3]!=0)
	echo "<td>$row[3]</td>";
else echo"<td></td>";

echo "<td>$row[4]</td>";


if ($row[5]!=0)
echo "<td>$row[5] kg </td>";
else echo "<td></td>";

if ($row[6]!=null)
echo "<td>$row[6] pollici</td>";
else echo "<td></td>";
echo "<td><a href=\"index.php?op=Modifica&bk=ModificaBike&tpp=$row[7]\"  class=\"shiny-button\">Modifica</a></td>";
echo "<td> <a href=\"index.php?op=Modifica&bk=EliminaBike&tpp=$row[7]\" onclick=\"return ConfermaEliminaBicicletta()\" class=\"shiny-button2\">Elimina</a></td>";
echo "</tr>";
}
echo "</table>";


}

function VisualizzaBicicletteOFF($cid,$ID_Utente){
	$pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);



$sql="SELECT Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Peso,Dimensione_Ruote, ID_Bike
 FROM Bicicletta where Proprietario IN (SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente')
 LIMIT $nrows OFFSET $offset";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
	echo "<table align='center' ><td>Non possiedi ancora biciclette.</td></table> </br>";
else{
	echo "<table align='center'>";
	echo "<tr><th>Marca</th><th>Colore</th><th>Anno di produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Peso</th><th>Dimensione ruote</th></tr>";
}
while ($row = $res->fetch_row()){
echo "<tr>";
echo "<td>$row[0]</td>";
echo "<td>$row[1]</td>";

if ($row[2]!=0)
	echo "<td>$row[2]</td>";
else echo"<td></td>";

if ($row[3]!=0)
	echo "<td>$row[3]</td>";
else echo"<td></td>";

echo "<td>$row[4]</td>";


if ($row[5]!=0)
echo "<td>$row[5] kg </td>";
else echo "<td></td>";

if ($row[6]!=null)
echo "<td>$row[6] pollici</td>";
else echo "<td></td>";
echo "<td><a href=\"index.php?op=Modifica&bk=ModificaBike&tpp=$row[7]\"  class=\"shiny-button\">Modifica</a></td>";
echo "<td> <a href=\"index.php?op=Modifica&bk=EliminaBike&tpp=$row[7]\"  class=\"shiny-button\">Elimina</a></td>";
echo "</tr>";
}
echo "<tr><td colspan='9'>";

$sql2="SELECT ID_Bike, Marca, Colore, Anno_Produzione, Anno_Acquisto, Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta where Proprietario IN (SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente')";
 $res2 = $cid->query($sql2)
	 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
 $numrows = $res2->num_rows;
 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Profilo&bkk=pagina'>";
 if($pagina!=1) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
<?php

	 echo '<input type="submit" class="shiny-button" value="Precedente">';
 }
echo "</form></div>";
echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Profilo&bkk=pagina">';
 if($pagina!=$paginaMax && $paginaMax!=0) {
	 ?>
	 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
<?php
	echo ' <input type="submit" class="shiny-button" value="Successivo">';
 }
echo "</form></div>";

 echo "</td></tr>";
 echo "</table>";
 echo '<br/><br/>';



}



function VisualizzaMercatinoFiltro($cid, $ID){

  /*$sql="SELECT Titolo,Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Prezzo,Descrizione,Stato,Venditore,ID_Annuncio
   FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) WHERE Stato='In vendita'";*/





   $pagina = 1;
 	if (isset($_POST["pagina"]))
 		$pagina = $_POST["pagina"];

 	$nrows = 5;
 	$offset = 5*($pagina-1);


    $sql="SELECT Titolo,Bicicletta.Marca,Bicicletta.Colore,Bicicletta.Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Annuncio.Prezzo,Descrizione,Stato,Venditore,ID_Annuncio
     FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) JOIN FiltroAnnuncio ON Utente='$ID'  WHERE Stato='In vendita' AND Bicicletta.Marca=FiltroAnnuncio.Marca AND Bicicletta.Colore=FiltroAnnuncio.Colore AND Annuncio.Prezzo<=FiltroAnnuncio.Prezzo
     LIMIT $nrows OFFSET $offset";

 	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
 	. ": " . $cid->error) . "</p>";

 	if ($res->num_rows==0)
 		echo "<table align='center'> <td>Non ci sono annunci corrispondenti al tuo filtro.</td></table> </br>";
 	else{
 		echo "<table align='center'>";
 		echo "<tr><th>Titolo annuncio</th><th>Marca</th><th>Colore</th><th>Anno di Produzione</th><th>Anno di acquisto</th><th>Tipo bicicletta</th><th>Prezzo</th><th>Descrizione</th><th>Stato</th></tr>";
 	}
 	while ($row = $res->fetch_row()){
 	echo "<tr>";
 	echo "<td>$row[0]</td>";
 	echo "<td>$row[1]</td>";
 	echo "<td>$row[2]</td>";
 	echo "<td>$row[3]</td>";
   echo "<td>$row[4]</td>";
   echo "<td>$row[5]</td>";
   echo "<td>$row[6]</td>";
   echo "<td>$row[7]</td>";
   echo "<td>$row[8]</td>";
   echo "<td><a href='./index.php?op=Mercatino&bk=VisualizzaMercatino&bkk=$row[9]&opann=$row[10]' class=\"shiny-button\" >Visualizza</a></td>";


 	echo "</tr>";
 	}
 	echo "<tr><td colspan='12'>";

 	$sql2="SELECT Titolo,Bicicletta.Marca,Bicicletta.Colore,Bicicletta.Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Annuncio.Prezzo,Descrizione,Stato,Venditore,ID_Annuncio
   FROM Annuncio INNER JOIN Bicicletta ON (Bicicletta=ID_Bike) JOIN FiltroAnnuncio ON Utente='$ID'  WHERE Stato='In vendita' AND Bicicletta.Marca=FiltroAnnuncio.Marca AND Bicicletta.Colore=FiltroAnnuncio.Colore AND Annuncio.Prezzo<=FiltroAnnuncio.Prezzo";
 	 $res2 = $cid->query($sql2)
 		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
 	 $numrows = $res2->num_rows;
 	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

 	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Mercatino&bk=VisualizzaMercatino'>";
 	 if($pagina!=1) {
 		 ?>
 		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
     <input type='hidden' name='FiltroAnnuncio' value="SI">
 	<?php

 		 echo '<input type="submit"  class="shiny-button" value="Precedente">';
 	 }
 	echo "</form></div>";
 	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Mercatino&bk=VisualizzaMercatino">';
 	 if($pagina!=$paginaMax && $paginaMax!=0) {
 		 ?>
 		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
     <input type='hidden' name='FiltroAnnuncio' value="SI">
 	<?php
 		echo ' <input type="submit" class="shiny-button" value="Successivo">';
 	 }
 	echo "</form></div>";

 	 echo "</td></tr>";
 	 echo "</table>";
 	 echo '<br/><br/>';
 }





function VisualizzaUsciteFiltroHome($cid, $data, $ID){
  $pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT ID_Uscita,Titolo, Uscita.Tipo_Uscita, Uscita.Livello_di_difficolta, Livello_di_visibilita, Uscita.Durata, Distanza, Dislivello, Ora, Uscita.Data, Uscita.Luogo, Valutazione, Note
	 FROM Uscita JOIN FiltroUscita ON Utente=$ID WHERE Uscita.Livello_di_visibilita='pubblica' AND Uscita.Data >= '$data' AND Organizzatore!=$ID AND Uscita.Durata<=FiltroUscita.Durata AND Uscita.Livello_di_difficolta=FiltroUscita.Livello_di_difficolta AND Uscita.Tipo_Uscita=FiltroUscita.Tipo_Uscita AND Uscita.Luogo=FiltroUscita.Luogo
   and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI')
   OR ID_Uscita in (select ID_Uscita from Uscita  JOIN FiltroUscita on Utente=$ID  WHERE Uscita.Livello_di_visibilita='privata' AND Uscita.Durata<=FiltroUscita.Durata AND Uscita.Livello_di_difficolta=FiltroUscita.Livello_di_difficolta AND Uscita.Tipo_Uscita=FiltroUscita.Tipo_Uscita AND Uscita.Luogo=FiltroUscita.Luogo
  AND Organizzatore in (SELECT Seguito FROM Segue  WHERE  Seguace=$ID) and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI'))
  LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center'class='inside' ><td>Non ci sono uscite corrispondenti al tuo filtro.</td></table> </br>";
	else{
		echo "<table align='center' class='bordi'>";
		echo "<tr><th>Titolo</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th>Valutazione</th><th>Note</th><th></th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5] ore</td>";
	echo "<td>$row[6] km</td>";
	echo "<td>$row[7] m</td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
	echo "<td>$row[10]</td>";
	echo "<td>$row[11]</td>";
	echo "<td>$row[12]</td>";
	echo "<td><a href=\"index.php?op=Uscite&tpp=$row[0]&opann=$row[1]\"  class=\"shiny-button\">Visualizza</a></td>";


	echo "</tr>";
	}
	echo "<tr><td colspan='13'>";

	$sql2="SELECT ID_Uscita,Titolo, Uscita.Tipo_Uscita, Uscita.Livello_di_difficolta, Livello_di_visibilita, Uscita.Durata, Distanza, Dislivello, Ora, Uscita.Data, Uscita.Luogo, Valutazione, Note
	 FROM Uscita JOIN FiltroUscita ON Utente=$ID WHERE Uscita.Livello_di_visibilita='pubblica' AND Uscita.Data >= '$data' AND Organizzatore!=$ID AND Uscita.Durata<=FiltroUscita.Durata AND Uscita.Livello_di_difficolta=FiltroUscita.Livello_di_difficolta AND Uscita.Tipo_Uscita=FiltroUscita.Tipo_Uscita AND Uscita.Luogo=FiltroUscita.Luogo
   and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI')
   OR ID_Uscita in (select ID_Uscita from Uscita  JOIN FiltroUscita on Utente=$ID  WHERE Uscita.Livello_di_visibilita='privata' AND Uscita.Durata<=FiltroUscita.Durata AND Uscita.Livello_di_difficolta=FiltroUscita.Livello_di_difficolta AND Uscita.Tipo_Uscita=FiltroUscita.Tipo_Uscita AND Uscita.Luogo=FiltroUscita.Luogo
  AND Organizzatore in (SELECT Seguito FROM Segue  WHERE  Seguace=$ID) and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI'))";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Uscite&bk=Uscite'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
     <input type="hidden" name="FiltroUscita" value="SI">
	<?php

		 echo '<input type="submit" class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Uscite&bk=Uscite">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
     <input type="hidden" name="FiltroUscita" value="SI">

	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';

}




function VisualizzaUsciteHome($cid, $data, $ID){
	$pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT ID_Uscita,Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Uscita.Data, Luogo, Valutazione, Note
	 FROM Uscita WHERE Livello_di_visibilita='pubblica' AND Uscita.Data >= '$data' AND Organizzatore!=$ID and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI')
 OR ID_Uscita in (select distinct(ID_Uscita) from Uscita JOIN Segue on Organizzatore=Seguito WHERE Seguace=$ID AND Livello_di_visibilita='privata' and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI'))
  LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query NIETE.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' class='bordi'><td>Non sono state ancora pubblicate uscite.</td></table> </br>";
	else{
		echo "<table align='center' class='inside'>";
		echo "<tr><th>Titolo</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th>Valutazione</th><th>Note</th><th></th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5] ore</td>";
	echo "<td>$row[6] km</td>";
	echo "<td>$row[7] m</td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
	echo "<td>$row[10]</td>";
	echo "<td>$row[11]</td>";
	echo "<td>$row[12]</td>";
	echo "<td><a href=\"index.php?op=Uscite&tpp=$row[0]&opann=$row[1]\"  class=\"shiny-button\">Visualizza</a></td>";


	echo "</tr>";
	}
	echo "<tr><td colspan='13'>";


	$sql2="SELECT ID_Uscita,Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Uscita.Data, Luogo, Valutazione, Note
	 FROM Uscita WHERE Livello_di_visibilita='pubblica' AND Uscita.Data >= '$data' AND Organizzatore!=$ID and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI')
 OR ID_Uscita in (select distinct(ID_Uscita) from Uscita JOIN Segue on Organizzatore=Seguito WHERE Seguace=$ID AND Livello_di_visibilita='privata' and ID_Uscita NOT IN (select ID_Uscita from Partecipanti where ID_Utente=$ID and Validita='SI'))";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Uscite&bk=Uscite'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit" class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Uscite&bk=Uscite">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';

}

function VisualizzaUsciteAcuiPartecipi($cid,$ID,$data){


	$sql="SELECT Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Data, Luogo, Note
	 FROM Uscita NATURAL JOIN Partecipanti where ID_Utente=$ID AND Data>=$data AND Validita='SI'";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non stai ancora partecipando ad alcuna uscita.</td></table> </br>";
	else{
    echo "<table align='center' class='bordi' >";
		echo "<tr><th>Titolo</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th>Note</th><th></th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
  echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4] ore</td>";
	echo "<td>$row[5] km</td>";
	echo "<td>$row[6] m</td>";
	echo "<td>$row[7] </td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
  echo "<td>$row[10]</td>";
  echo "<td><a href='./index.php?op=xml&xml1=$row[0]&xml2=$row[1]&xml3=$row[2]&xml4=$row[4]&xml5=$row[5]&xml6=$row[6]&xml7=$row[7]&xml8=$row[8]&xml9=$row[9]'  class=\"shiny-button\">XML</a></td>";
	echo "</tr>";
	}
  echo "</table>";
	 echo '<br/><br/>';

}


function VisualizzaUsciteAcuiHaiPartecipato($cid,$ID,$data){


	$sql="SELECT Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Data, Luogo, Valutazione, Note, ID_Uscita
	 FROM Uscita NATURAL JOIN Partecipanti where ID_Utente=$ID AND Data<$data AND Validita='SI'";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non hai partecipato a nessuna uscita.</td></table> </br>";
	else{
    echo "<table align='center' class='bordi'>";
		echo "<tr><th>Titolo</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th></th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
  echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]ore</td>";
	echo "<td>$row[5] km</td>";
	echo "<td>$row[6] m</td>";
	echo "<td>$row[7] </td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
	echo "<td>$row[10]</td>";
	echo "<td>$row[11]</td>";
	echo "</tr>";
	}
	echo "</table>";
	 echo '<br/><br/>';

}

function VisualizzaUsciteOrganizzateDate($cid,$ID_Utente){
	$pagina = 1;
	if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT ID_Uscita,Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Data, Luogo, Valutazione, Note
	 FROM Uscita where Organizzatore=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente')
	 LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non hai ancora pubblicato uscite.</td></table> </br>";
	else{
		echo "<table align='center' class='bordi'>";
		echo "<tr><th>Titolo</th><th>Tipo di uscita</th><th>Livello di difficolta</th><th>Livello di visibilita</th><th>Durata</th><th>Lunghezza</th><th>Dislivello</th><th>Ora</th><th>Data</th><th>Luogo</th><th>Valutazione</th><th>Note</th><th>Tappe</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5] ore</td>";
	echo "<td>$row[6] km</td>";
	echo "<td>$row[7] m</td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
	echo "<td>$row[10]</td>";
	echo "<td>$row[11]</td>";
	echo "<td>$row[12]</td>";

	echo "<td><a href=\"index.php?op=Tappe&tpp=$row[0]&bk=$row[1]&bkk=$row[6]\"  class=\"shiny-button\">Tappe</a></td>";
	echo "<td><a href=\"index.php?op=TueUscite&tpp=$row[0]&oprim=RimuoviUscita\" onclick=\"return ConfermaEliminaUscita()\"  class=\"shiny-button2\">Rimuovi</a></td>";
	echo "</tr>";
	}
	echo "<tr><td colspan='13'>";

	$sql2="SELECT ID_Uscita,Titolo, Tipo_Uscita, Livello_di_difficolta, Livello_di_visibilita, Durata, Distanza, Dislivello, Ora, Data, Luogo, Valutazione, Note
	 FROM Uscita where Organizzatore=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID_Utente')";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=TueUscite'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit"  class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=TueUscite">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';

}

function VisualizzaNotifiche($cid,$ID){
  $sql="SELECT Nome_Utente, Titolo, ID_Uscita, ID_Utente, ID_Bike
   FROM Partecipanti NATURAL JOIN Profilo NATURAL JOIN Uscita NATURAL JOIN Bicicletta NATURAL JOIN Utente where Organizzatore='$ID' AND Validita='NO'";

   $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";

  if ($res->num_rows==0)
    echo "<table align='center' ><i><td>Non ci sono notifiche!</td></i></table> </br>";
    //echo "<a href=\"index.php?op=InserisciTappe\" class=\"button2 active\">inserisci un'altra tappa</a> <br/>";}
  else{
    echo "<table align='center'>";
  while ($row = $res->fetch_row()){
  echo "<tr>";
  echo "<td>L'utente ".strtoupper($row[0])." vorrebbe partecipare alla tua uscita: ".strtoupper($row[1]);
  echo "<form method='GET' action='common/AccettaPartecipante.php' name='AccettaPartecipante'>
          <td><input type='submit' class='shiny-button' value='accetta'>
          <input type='hidden' name='Utente' value='$row[3]'>
          <input type='hidden' name='Uscita' value='$row[2]'>
          <input type='hidden' name='Bike' value='$row[4]'></form><td></td>
        <form method='GET' action='common/RifiutaPartecipante.php' name='rifiutaPartecipante'>
                <td><input type='submit' class='shiny-button2' value='rifiuta'>
                <input type='hidden' name='Utente' value='$row[3]'>
                <input type='hidden' name='Uscita' value='$row[2]'>
                <input type='hidden' name='Bike' value='$row[4]'></form><td></td>";
  echo "</tr>";
  }

   echo "</table>";
  echo "<br>";
  }


}

function AccettaPartecipante($cid,$ID_Utente, $ID_Uscita,$ID_Bike ){
  $query = "UPDATE Partecipanti SET Validita='SI'
	WHERE ID_Utente='$ID_Utente' AND ID_Uscita='$ID_Uscita' AND ID_Bike='$ID_Bike'";
	$res = $cid->query($query)
		or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	$accetta = 1; // notifica la riuscita dalla aggiunta

		if($accetta){
      /*$msg= 'Hai accettato la richiesta di partecipazione!';
      $msg= base64_encode($msg);*/
			header("location: ../index.php?op=Richieste");
    }
}

function RifiutaPartecipante($cid,$ID_Utente, $ID_Uscita,$ID_Bike ){
  $query = "DELETE FROM Partecipanti
	WHERE ID_Utente='$ID_Utente' AND ID_Uscita='$ID_Uscita' AND ID_Bike='$ID_Bike'";
	$res = $cid->query($query)
		or die("Impossibile eseguire modifica! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	$rifiuta = 1; // notifica la riuscita dalla aggiunta

		if($rifiuta){
      /*$msg= 'Hai rifiutato la richiesta di partecipazione!';
      $msg= base64_encode($msg);*/
			header("location: ../index.php?op=Richieste");
    }


}

function VisualizzaCiclisti($cid,$ID,$PaginaCorrente){
	$pagina = 1;



	if($PaginaCorrente!="")
		$pagina=$PaginaCorrente;

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT *	FROM Profilo WHERE ID_Utente != $ID
	LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non hai ancora pubblicato uscite.</td></table> </br>";
	else{
		echo "<table align='center'>";
		echo "<tr><th></th><th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Luogo di nascita</th><th>Dove vive</th><th>Sesso</th><th>Tipo di ciclista</th></tr>";
	}

	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td><img style ='height : 15px; width : 15px;' src='img/Logo_Utente.png'></img></td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5] </td>";
	echo "<td>$row[7] </td>";
	echo "<td>$row[9]</td>";
	$MioID=$ID;
	$AltroID=$row[0];
	if(issetSeguiCiclista($cid, $MioID,$AltroID)){

		echo "<td><form name='Segui' method='post' action='common/NonSeguireUtente.php?tpp=$pagina'><input type='submit' name='PulsanteNonSeguire' class='shiny-button2' value='Non seguire più'>
				<input type='hidden' value='$row[0]' name='IDCiclistaSeguito'> </form></td>";
	}
	else
	echo "<td><form name='Segui' method='post' action='common/SeguiUtente.php?tpp=$pagina'><input type='submit' name='PulsanteSeguire'class='shiny-button' value='Segui'>
					<input type='hidden' value='$row[0]' name='IDCiclistaSeguito'> </form></td>";


	echo "</tr>";
	}

	Unset($res);
	echo "<tr><td colspan='9'>";

	$sql2="SELECT *	FROM Profilo WHERE ID_Utente != $ID";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Ciclisti&page="; echo $pagina-1;echo"'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit" class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
  echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Ciclisti&page="; echo $pagina+1;echo"'>";
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';
}




function VisualizzaAmici($cid,$ID){
	$pagina = 1;

  if (isset($_POST["pagina"]))
		$pagina = $_POST["pagina"];

	$nrows = 5;
	$offset = 5*($pagina-1);

	$sql="SELECT Nome, Cognome, Data_Nascita, Luogo_Nascita, Citta, Sesso, Tipo_Profilo, ID_Utente	FROM Profilo INNER JOIN Segue ON(ID_Utente = Seguito) WHERE Seguace=$ID
	LIMIT $nrows OFFSET $offset";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non segui nessun Ciclista.</td></table> </br>";
	else{
		echo "<table align='center' class='bordi'>";
		echo "<tr><th></th><th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Luogo di nascita</th><th>Dove vive</th><th>Sesso</th><th>Tipo di ciclista</th></tr>";
	}

	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td><img style ='height : 15px; width : 15px;' src='img/Logo_Utente.png'></img></td>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5] </td>";
	echo "<td>$row[6] </td>";
	$MioID=$ID;
	$AltroID=$row[7];
	if(issetSeguiCiclista($cid, $MioID,$AltroID)){

		echo "<td><form name='Segui' method='post' action='common/NonSeguireUtente.php?op=seguiAmici&tpp=$pagina'><input type='submit' name='PulsanteNonSeguire' class='shiny-button2' value='Non seguire più'>
				<input type='hidden' value='$row[7]' name='IDCiclistaSeguito'> </form></td>";
	}
	echo "</tr>";
	}
	Unset($res);
	echo "<tr><td colspan='9'>";

	$sql2="SELECT Nome, Cognome, Data_Nascita, Luogo_Nascita, Citta, Sesso, Tipo_Profilo	FROM Profilo INNER JOIN Segue ON(ID_Utente = Seguito) WHERE Seguace=$ID
";
	 $res2 = $cid->query($sql2)
		 or die("Impossibile eseguire query. <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");
	 $numrows = $res2->num_rows;
	 $paginaMax = ceil($numrows/$nrows); //con ceil arrotondo per eccesso

	 echo "<div style='float: left; width: 50%; text-align: right;'> <form style'float: left;' method='POST' action='./index.php?op=Profilo'>";
	 if($pagina!=1) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina-1; ?>">
	<?php

		 echo '<input type="submit"  class="shiny-button" value="Precedente">';
	 }
	echo "</form></div>";
	echo '<div style="float: right; width: 50%; text-align: left;"> <form style="float: left;" method="POST" action="./index.php?op=Profilo">';
	 if($pagina!=$paginaMax && $paginaMax!=0) {
		 ?>
		 <input type='hidden' name='pagina' value="<?php echo $pagina+1; ?>">
	<?php
		echo ' <input type="submit" class="shiny-button" value="Successivo">';
	 }
	echo "</form></div>";

	 echo "</td></tr>";
	 echo "</table>";
	 echo '<br/><br/>';
}



function issetSeguiCiclista($cid, $MioID,$AltroID){
	$sql= "SELECT * FROM Segue WHERE Seguace='$MioID'and Seguito='$AltroID'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else
  		return true;
		}
	return false;
}



function InserisciPartecipante($cid,$ID,$ID_Uscita,$opBkk){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
		//echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($ID) || empty($ID_Uscita)|| empty($opBkk))
		 $errore="Non puoi partecipare";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else{
		$sql = "INSERT INTO Partecipanti VALUES ('$ID', '$ID_Uscita','$opBkk','NO');";
		$res=$cid->query($sql);
	}

$risultato["msg"]=$msg;
return $risultato;
}

function SeguiUtente($cid,$Seguace, $Seguito,$data){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($Seguace) || empty($Seguito))
		 $errore="Non puoi seguire questo utente.";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else{
		$sql = "INSERT INTO Segue VALUES ('$Seguace', '$Seguito','$data');";
		$res=$cid->query($sql);
	/*	if ($res->affected_rows==1){
			$msg= "<div class=\"errore\">  Non posso inserire la tupla in Segue </div>";
		    $risultato["status"]=0;
		}*/
	}

$risultato["msg"]=$msg;
return $risultato;

}



function RecuperaNumFollowers($cid,$Seguito){
	$sql= "SELECT Numero_Followers FROM Profilo WHERE ID_Utente='$Seguito'";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}

function InserisciNumFollowers($cid,$Seguito,$NumFollowers){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
  if(empty($NumFollowers))
    $NumFollowers=0;

	if (empty($Seguito)){
		 $errore="Mancano dei fottutissimi dati";

  }


	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else
	{
		$sql = "UPDATE Profilo SET Numero_Followers=$NumFollowers WHERE ID_Utente=$Seguito";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msg= "<div class=\"errore\">  Non posso aggiornare il numero di followers </div>";
		    $risultato["status"]=0;

		}
	}
	$risultato["msg"]=$msg;
	return $risultato;
}



function EliminaSegui($cid,$Seguace,$Seguito){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($Seguace) || empty($Seguito))
		 $errore="Mancano dei dati";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else
	{
		$sql = "DELETE FROM Segue WHERE Seguace='$Seguace' and Seguito=$Seguito";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msg= "<div class=\"errore\">  Non posso eliminare la tupla in Segue </div>";
		    $risultato["status"]=0;

		}
	}
	$risultato["msg"]=$msg;
	return $risultato;

}



function visualizzaTappe($cid,$ID_Uscita){


	$sql="SELECT Numero_Progressivo, Lunghezza, Tipo_Tappa
	 FROM Tappa where ID_Uscita=(SELECT ID_Uscita FROM Uscita WHERE ID_Uscita= '$ID_Uscita')";

	 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	. ": " . $cid->error) . "</p>";

	if ($res->num_rows==0)
		echo "<table align='center' ><td>Non hai ancora inserito delle tappe.</td></table> </br>";
		//echo "<a href=\"index.php?op=InserisciTappe\" class=\"button2 active\">inserisci un'altra tappa</a> <br/>";}
	else{
		echo "<table align='center'>";
		echo "<tr><th>num</th><th>Lunghezza</th><th>Tipo di tappa</th></tr>";
	}
	while ($row = $res->fetch_row()){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1] km</td>";
	echo "<td>$row[2]</td>";
	echo "</tr>";
	}

	echo "</table>";


}

function VisualizzaProfilo($cid,$ID){
$sql="SELECT Nome,Cognome,Data_Nascita,Luogo_Nascita,Citta,E_mail, Sesso,Numero_Followers,Tipo_Profilo,ID_Utente
 FROM Profilo where ID_Utente=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID')";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

echo "<table align='center' class='bordi'>
					<tr><th> Nome </th><th> Cognome </th><th> Data di nascita </th> <th> Luogo di nascita </th> <th> Città </th><th> Email </th><th> Sesso </th> <th> Followers </th><th> Livello </th></tr> ";
 while($row=$res->fetch_row()){

	 echo '<tr>';

		echo " <td> $row[0]</td>";
		echo " <td> $row[1]</td>";
		echo " <td>  $row[2]</td>";
		echo " <td> $row[3]</td>";
			echo " <td>$row[4]</td>";
			echo " <td>  $row[5]</td>";
			echo " <td> $row[6]</td>";
			echo " <td> $row[7]</td>";
			echo " <td> $row[8]</td>";
			echo "<td><a href=\"index.php?op=Modifica&bk=ModificaProfilo&tpp=$row[0]\"  class=\"shiny-button\">Modifica</a></td>";
      if($row[7]==0)
      echo "<td><a href=\"index.php?op=Modifica&bk=EliminaProfilo&tpp=$row[9]\" onclick=\"return ConfermaEliminaProfilo()\"  class=\"shiny-button2\">Elimina profilo</a></td>";
		echo "</tr>";
 }
 Unset($res);
 echo "</table>";

}

function RecuperaMaxID_Bike($cid){
	$sql= "SELECT max(ID_Bike)FROM Bicicletta";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}

function RecuperaMaxID_Uscite($cid){
	$sql= "SELECT max(ID_uscita)FROM Uscita";
	$res=$cid->query($sql) or die();
	if ($res){
		if ($res->num_rows==0)
			return false;
		else {
  		while($row=$res->fetch_row()){
		 		return $row[0];
			}
		}
	return false;
	}
}



function InserisciBicicletta($cid,$ID_Bike, $Proprietario, $Marca, $Colore,$Anno_Produzione, $Anno_Acquisto,$Tipo_Bicicletta,$Peso,$Dimensione_Ruote  ){
	$risultatoBicicletta=array("msg" => "", "status" => 1);
	$msg="";
	$erroreBicicletta="";
    //echo "$sq1,$sq2,$ris1,$ris2";

	if (empty($Marca) || empty($Colore) || empty($Tipo_Bicicletta))
		 $erroreBicicletta="Marca, colore e tipo bicicletta devono essere specificati;";

	if (!empty($erroreBicicletta))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $erroreBicicletta </div>";
		$risultatoBicicletta["status"]=0;
	}
	else
	{
		$sql = "INSERT INTO Bicicletta VALUES ('$ID_Bike', '$Proprietario', '$Marca', '$Colore','$Anno_Produzione', '$Anno_Acquisto','$Tipo_Bicicletta','$Peso','$Dimensione_Ruote');";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msgBicicletta= "<div class=\"errore\">  Non posso inserire questo utente </div>";
		    $risultatoBicicletta["status"]=0;

		}
	}
	$risultatoBicicletta["msg"]=$msg;
	return $risultatoBicicletta;

$risultatoBicicletta["msg"]=$msg;
return $risultatoBicicletta;
}

function InserisciUscita($cid,$ID_Uscita,$Organizzatore,$Titolo,$Tipo_Uscita,$Livello_Difficoltà,
					$Livello_Visibilità,$Durata,$Distanza,$Dislivello,$Ora,$Data,$Luogo,$Valutazione,$Note){

						$risultatoUscita=array("msg" => "", "status" => 1);
						$msg="";
						$erroreUscita="";

						if (empty($ID_Uscita) || empty($Organizzatore) || empty($Titolo)|| empty($Tipo_Uscita)|| empty($Livello_Difficoltà)
								|| empty($Livello_Visibilità)|| empty($Durata)|| $Distanza<0|| $Dislivello<0 || empty($Ora)|| empty($Ora)|| empty($Data)|| empty($Luogo))
							 $erroreUscita=" non sono stati inseriti i campi obbligatori, identificati da '*'.";

						if (!empty($erroreUscita))
						{
							$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $erroreUscita </div>";
							$risultatoUscita["status"]=0;
						}
						else
						{
							$sql = "INSERT INTO Uscita VALUES ('$ID_Uscita','$Organizzatore','$Titolo','$Tipo_Uscita','$Livello_Difficoltà',
												'$Livello_Visibilità','$Durata','$Distanza','$Dislivello','$Ora','$Data','$Luogo','$Valutazione','$Note');";
							$res=$cid->query($sql);
							if ($res->affected_rows==1)
							{
								$msgUscita= "<div class=\"errore\">  Non posso inserire questa uscita </div>";
									$risultatoUscita["status"]=0;

							}
						}
						$risultatoUscita["msg"]=$msg;
						return $risultatoUscita;

					$risultatoUscita["msg"]=$msg;
					return $risultatoUscita;

																		}





function InserisciProfilo($cid,$ID_Utente, $Nome, $Cognome, $DataN,$LuogoN, $Città,$Email,$Sesso,$Nfollowers,$Tipo_Profilo  ){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
    //echo "$sq1,$sq2,$ris1,$ris2";
	if (empty($Nome) || empty($Cognome) || empty($Tipo_Profilo)|| empty($Email))
		 $errore="Nome, cognome, livello ed Email devono essere specificati;";

	if (!empty($errore))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $errore </div>";
		$risultato["status"]=0;
	}
	else
	{
		$sql = "INSERT INTO Profilo VALUES ('$ID_Utente', '$Nome', '$Cognome', '$DataN','$LuogoN', '$Città','$Email','$Sesso','$Nfollowers','$Tipo_Profilo');";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msg= "<div class=\"errore\">  Non posso inserire questo utente </div>";
		    $risultato["status"]=0;

		}
	}
	$risultato["msg"]=$msg;
	return $risultato;

$risultato["msg"]=$msg;
return $risultato;
}


function InserisciTappa($cid,$Num_Progressivo,$ID_Uscita,$Lunghezza,$TipoTappa){
	$risultatoTappa=array("msg" => "", "status" => 1);
	$msg="";
	$erroreTappa="";
		//echo "$sq1,$sq2,$ris1,$ris2";

	if (empty($Lunghezza) || empty($TipoTappa) || empty($Num_Progressivo)|| empty($ID_Uscita))
		 $erroreBicicletta="Non hai inserito i campi obbligatori!";

	if (!empty($erroreTappa))
	{
		$msg= "<div class=\"errore\">  Si sono verificati i seguenti errori:  $erroreTappa </div>";
		$risultatoTappa["status"]=0;
	}
	else
	{
		$sql = "INSERT INTO Tappa VALUES ('$Num_Progressivo','$ID_Uscita','$Lunghezza','$TipoTappa');";
		$res=$cid->query($sql);
		if ($res->affected_rows==1)
		{
			$msgTappa= "<div class=\"errore\">  Non posso inserire questa tappa </div>";
				$risultatoTappa["status"]=0;

		}
	}
	$risultatoTappa["msg"]=$msg;
	return $risultatoTappa;

$risultatoTappa["msg"]=$msg;
return $risultatoTappa;
}

function ModificaStatoAnnuncio($cid,$Annuncio,$Stato){

  $date=date('Y-m-d');

    $sql="UPDATE Annuncio SET Stato='Venduta',Data_Vendita='$date' WHERE ID_Annuncio='$Annuncio'";
    $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error) . "</p>";


    header('location:./index.php?op=TuoiAnnunci');
}


 ?>
