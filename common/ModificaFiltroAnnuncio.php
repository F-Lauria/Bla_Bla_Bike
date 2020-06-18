<?php
$sql="SELECT Marca,Colore,Prezzo,ID_FiltroAnnuncio FROM FiltroAnnuncio WHERE ID_FiltroAnnuncio='$FiltroAnnuncioDaModificare'";

$res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

if ($res->num_rows==0)
 echo "<table align='center' class='bordi'><td><a href='./index.php?op=Profilo&bkk=FiltroAnnuncio' class=\"shiny-button\" >Inserisci un filtro per gli annunci</a></td></table> </br>";
else {
echo "<table align='center'>";

while($row=$res->fetch_row()) {
  echo '<form name="ModificaFiltro" action="common/ModificaFiltroAnnuncioE.php" onsubmit="return ConfermaModificaFiltroAnnuncio()" method="GET">';
  echo '<tr>';
echo  " <td>Marca:</td>";
echo "<td> <select name='Marche' required>";
    if($row[0]=="Bianchi") echo "
    <option name='Marca' value='Bianchi' selected >Bianchi</option>
    <option name='Marca' value='Rossignoli'>Rossignoli</option>
    <option name='Marca' value='BeTween'>BeTween</option>
    <option name='Marca' value='Scott'>Scott</option>
    <option name='Marca' value='Specialized'>Specialized</option>
    <option name='Marca' value='Cannondale'>Cannondale</option>
  </select>";
  if($row[0]=="Rossignoli") echo "
  <option name='Marca' value='Bianchi'  >Bianchi</option>
  <option name='Marca' value='Rossignoli' selected >Rossignoli</option>
  <option name='Marca' value='BeTween'>BeTween</option>
  <option name='Marca' value='Scott'>Scott</option>
  <option name='Marca' value='Specialized'>Specialized</option>
  <option name='Marca' value='Cannondale'>Cannondale</option>
</select>";
if($row[0]=="BeTween") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween' selected >BeTween</option>
<option name='Marca' value='Scott'>Scott</option>
<option name='Marca' value='Specialized'>Specialized</option>
<option name='Marca' value='Cannondale'>Cannondale</option>
</select>";
if($row[0]=="Scott") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott' selected >Scott</option>
<option name='Marca' value='Specialized'>Specialized</option>
<option name='Marca' value='Cannondale'>Cannondale</option>
</select>";
if($row[0]=="Specialized") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott'  >Scott</option>
<option name='Marca' value='Specialized' selected >Specialized</option>
<option name='Marca' value='Cannondale'>Cannondale</option>
</select>";
if($row[0]=="Cannondale") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott'  >Scott</option>
<option name='Marca' value='Specialized'  >Specialized</option>
<option name='Marca' value='Cannondale' selected>Cannondale</option>
</select>";
echo "  <tr>
    <td>Colore: </td>
    <td><select name='Colore'>";
        if($row[1]=="Rosso") echo "
        <option value='Rosso' selected >Rosso</option>
        <option value='Blu'>Blu</option>
        <option value='Nero'>Nero</option>
        <option value='Bianco'>Bianco</option>
        <option value='Giallo'>Giallo</option>
        <option value='Verde'>Verde</option>
        <option value='Arancione'>Arancione</option>
        <option value='Viola'>Viola</option>
        <option value='Rosa'>Rosa</option>
    </select> </td>
  </tr>";
  if($row[1]=="Blu") echo "
  <option value='Rosso' >Rosso</option>
  <option value='Blu' selected>Blu</option>
  <option value='Nero'>Nero</option>
  <option value='Bianco'>Bianco</option>
  <option value='Giallo'>Giallo</option>
  <option value='Verde'>Verde</option>
  <option value='Arancione'>Arancione</option>
  <option value='Viola'>Viola</option>
  <option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Nero") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'selected>Nero</option>
<option value='Bianco'>Bianco</option>
<option value='Giallo'>Giallo</option>
<option value='Verde'>Verde</option>
<option value='Arancione'>Arancione</option>
<option value='Viola'>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Bianco") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco' selected >Bianco</option>
<option value='Giallo'>Giallo</option>
<option value='Verde'>Verde</option>
<option value='Arancione'>Arancione</option>
<option value='Viola'>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Giallo") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco'  >Bianco</option>
<option value='Giallo' selected>Giallo</option>
<option value='Verde'>Verde</option>
<option value='Arancione'>Arancione</option>
<option value='Viola'>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Verde") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco'  >Bianco</option>
<option value='Giallo' >Giallo</option>
<option value='Verde' selected>Verde</option>
<option value='Arancione'>Arancione</option>
<option value='Viola'>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Arancione") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco'  >Bianco</option>
<option value='Giallo' >Giallo</option>
<option value='Verde' >Verde</option>
<option value='Arancione' selected>Arancione</option>
<option value='Viola'>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Viola") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco'  >Bianco</option>
<option value='Giallo' >Giallo</option>
<option value='Verde' >Verde</option>
<option value='Arancione' >Arancione</option>
<option value='Viola' selected>Viola</option>
<option value='Rosa'>Rosa</option>
</select> </td>
</tr>";
if($row[1]=="Rosa") echo "
<option value='Rosso' >Rosso</option>
<option value='Blu' >Blu</option>
<option value='Nero'>Nero</option>
<option value='Bianco'  >Bianco</option>
<option value='Giallo' >Giallo</option>
<option value='Verde' >Verde</option>
<option value='Arancione' >Arancione</option>
<option value='Viola' >Viola</option>
<option value='Rosa' selected >Rosa</option>
</select> </td>
</tr>";
   echo " <tr> <td> Prezzo massimo: </td> <td><input type='number' name='Prezzo' value='$row[2]'</td>";
   echo "</tr>";

   echo "<input type='hidden' name='FiltroAnnuncioDaModificare' value='$FiltroAnnuncioDaModificare'> ";
}
}
echo "<tr><td colspan='2'>";

echo '<input type="submit" class="shiny-button" value="Modifica">';// <!-- una volta che clicco modifica ritorno all'esercio 8 e faccio l'update -->
echo "</form>";


echo '<form style="float:left;" method="POST" action="index.php?op=Profilo">';// <!-- con questa form torno all'esercizio 8 SENZA fare l'update -->
echo '<input type="submit" class="shiny-button" value="Ho cambiato idea">';
echo ' </form>';

echo "</td></tr>";
echo "</table>";
?>
