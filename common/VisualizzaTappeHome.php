<?php







$sql="SELECT Numero_Progressivo, Lunghezza, Tipo_Tappa
 FROM Tappa where ID_Uscita=(SELECT ID_Uscita FROM Uscita WHERE ID_Uscita= '$ID_Uscita')";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
  echo "<table align='center' ><td>Non sono state inserite tappe per questa uscite</td></table> </br>";
  //echo "<a href=\"index.php?op=InserisciTappe\" class=\"button2 active\">inserisci un'altra tappa</a> <br/>";}
else{
  echo "<table align='center' class='bordi'>";
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

echo "<br>";
?>
