<?php

$sql="SELECT Durata,Livello_di_difficolta,Tipo_Uscita,Luogo FROM FiltroUscita WHERE ID_FiltroUscita='$FiltroUscitaDaModificare'";

$res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
 echo "<table align='center'><td><a href='./index.php?op=Profilo&bkk=FiltroUscita' class=\"shiny-button\"> Inserisci un filtro per le uscite</a></td></table> </br>";
else {
echo "<table align='center' class='bordi'>";

while($row=$res->fetch_row()) {
  echo '<form name="ModificaFiltro" action="common/ModificaFiltroUscitaE.php" onsubmit="return ConfermaModificaFiltroUscita()" method="GET">';
  echo "<tr>";
  echo "<td> Durata massima: </td>";
  echo "<td> <input type='number' name='DurataMax' value='$row[0]'> </td>";
  echo "<tr>";
  echo "<td> Livello di difficolta: </td>";
  echo "<td><select name='LivelloDifficoltà'required>";
    if($row[1]=="basso") echo "
    <option name='basso' value='basso' selected >Basso</option>
    <option name='medio' value='medio'>Medio</option>
    <option name='alto' value='alto'>Alto</option>
  </select> </td>";
  if($row[1]=="medio") echo "
  <option name='basso' value='basso'  >Basso</option>
  <option name='medio' value='medio' selected >Medio</option>
  <option name='alto' value='alto'>Alto</option>
</select> </td>";
if($row[1]=="alto") echo "
<option name='basso' value='basso'  >Basso</option>
<option name='medio' value='medio'  >Medio</option>
<option name='alto' value='alto' selected >Alto</option>
</select> </td>";
  echo "</tr>";
echo "<tr>";
  echo "  <td>Tipo di uscita:</td>";
  echo"<td><select name='TipoUscita'required>";
      if($row[2]=='corsa') echo "
      <option name='corsa' value='corsa' selected >Bici da corsa</option>
      <option name='mountainbike' value='mountain bike'>Mountain bike</option>
    </select> </td>";
    if($row[2]=='mountain bike') echo "
    <option name='corsa' value='corsa'  >Bici da corsa</option>
    <option name='mountainbike' value='mountain bike' selected >Mountain bike</option>
  </select> </td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td> Luogo: </td>";
  echo "<td> <input type='text' name='Luogo' value='$row[3]'> </td>";
  echo "</tr>";

  echo "<input type='hidden' name='FiltroUscitaDaModificare' value='$FiltroUscitaDaModificare'> ";

}

echo "<tr><td colspan='2'>";

echo '<input type="submit" class="shiny-button" value="Modifica">';// <!-- una volta che clicco modifica ritorno all'esercio 8 e faccio l'update -->
echo "</form>";


echo '<form style="float:left;" method="POST" action="index.php?op=Profilo">';// <!-- con questa form torno all'esercizio 8 SENZA fare l'update -->
echo '<input type="submit" class="shiny-button" value="Ho cambiato idea">';
echo ' </form>';

echo "</td></tr>";
echo "</table>";
}

 ?>
