
<script>
function active_corsa(){
  document.getElementsByName('Peso')[0].disabled=false;
  document.getElementsByName('DimensioneRuote')[0].disabled=true;
}

function active_mountain(){
  document.getElementsByName('Peso')[0].disabled=true;
  document.getElementsByName('DimensioneRuote')[0].disabled=false;
}



function active_marca(){
  if(document.getElementsByName("Altro")[0].disabled==false){
  document.getElementsByName("Altro")[0].disabled=true;
  document.getElementsByName("Marche")[0].disabled=false;
  }
  else{
  document.getElementsByName("Altro")[0].disabled=false;
  document.getElementsByName("Marche")[0].disabled=true;
  }
}
</script>


<?php
$sql="SELECT Marca,Colore,Anno_Produzione,Anno_Acquisto,Tipo_Bicicletta,Peso,Dimensione_Ruote
 FROM Bicicletta where ID_Bike='$BiciDaModificare'";


 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
 . ": " . $cid->error) . "</p>";

 echo "<table align='center'>";

  while($row=$res->fetch_row()){
    echo '<form name="InserisciBici" action="common/ModificaBiciclettaE.php" onsubmit="return ConfermaModificaBicicletta()" method="GET">';
      echo '<table align="center" class="bordi">';
        echo '<tr>';
        echo  " <td>Marca:</td>";
        if($row[0]=="Cannondale" || $row[0]=="Specialized" || $row[0]=="Scott" || $row[0]=="BeTween" || $row[0]=="Rossignoli" || $row[0]=="Bianchi"){
        echo "<td> <select name='Marche' required>";
            if($row[0]=="Bianchi") echo "
            <option name='Marca' value='Bianchi' selected >Bianchi</option>
            <option name='Marca' value='Rossignoli'>Rossignoli</option>
            <option name='Marca' value='BeTween'>BeTween</option>
            <option name='Marca' value='Scott'>Scott</option>
            <option name='Marca' value='Specialized'>Specialized</option>
            <option name='Marca' value='Cannondale'>Cannondale</option>
          </select>
          <input type='button' value='altro' onclick='active_marca();'>
          <input type='text' name='Altro' disabled required>
         * </td>
        </tr>";
        if($row[0]=="Rossignoli") echo "
        <option name='Marca' value='Bianchi'  >Bianchi</option>
        <option name='Marca' value='Rossignoli' selected >Rossignoli</option>
        <option name='Marca' value='BeTween'>BeTween</option>
        <option name='Marca' value='Scott'>Scott</option>
        <option name='Marca' value='Specialized'>Specialized</option>
        <option name='Marca' value='Cannondale'>Cannondale</option>
      </select>
      <input type='button' value='altro' onclick='active_marca();'>
      <input type='text' name='Altro' disabled required>
     * </td>
    </tr>";
    if($row[0]=="BeTween") echo "
    <option name='Marca' value='Bianchi'  >Bianchi</option>
    <option name='Marca' value='Rossignoli'  >Rossignoli</option>
    <option name='Marca' value='BeTween' selected >BeTween</option>
    <option name='Marca' value='Scott'>Scott</option>
    <option name='Marca' value='Specialized'>Specialized</option>
    <option name='Marca' value='Cannondale'>Cannondale</option>
  </select>
  <input type='button' value='altro' onclick='active_marca();'>
  <input type='text' name='Altro' disabled required>
 * </td>
</tr>";
if($row[0]=="Scott") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott' selected >Scott</option>
<option name='Marca' value='Specialized'>Specialized</option>
<option name='Marca' value='Cannondale'>Cannondale</option>
</select>
<input type='button' value='altro' onclick='active_marca();'>
<input type='text' name='Altro' disabled required>
* </td>
</tr>";
if($row[0]=="Specialized") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott'  >Scott</option>
<option name='Marca' value='Specialized' selected >Specialized</option>
<option name='Marca' value='Cannondale'>Cannondale</option>
</select>
<input type='button' value='altro' onclick='active_marca();'>
<input type='text' name='Altro' disabled required>
* </td>
</tr>";
if($row[0]=="Cannondale") echo "
<option name='Marca' value='Bianchi'  >Bianchi</option>
<option name='Marca' value='Rossignoli'  >Rossignoli</option>
<option name='Marca' value='BeTween'  >BeTween</option>
<option name='Marca' value='Scott'  >Scott</option>
<option name='Marca' value='Specialized'  >Specialized</option>
<option name='Marca' value='Cannondale' selected>Cannondale</option>
</select>
<input type='button' value='altro' onclick='active_marca();'>
<input type='text' name='Altro' disabled required>
* </td>
</tr>";

}

else {
    echo "<td> <select name='Marche' required disabled>";
    echo "
    <option name='Marca' value='Bianchi'  >Bianchi</option>
    <option name='Marca' value='Rossignoli'  >Rossignoli</option>
    <option name='Marca' value='BeTween'  >BeTween</option>
    <option name='Marca' value='Scott'  >Scott</option>
    <option name='Marca' value='Specialized'  >Specialized</option>
    <option name='Marca' value='Cannondale'>Cannondale</option>
    </select>
    <input type='button' value='altro' onclick='active_marca();'>
    <input type='text' name='Altro' value='$row[0]' required>
    * </td>
    </tr>";
}


      echo "  <tr>
          <td>Colore: </td>
          <td><select name='Colore'required>";
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
          </select> *</td>
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
    </select> *</td>
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
</select> *</td>
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
</select> *</td>
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
</select> *</td>
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
</select> *</td>
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
</select> *</td>
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
</select> *</td>
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
</select> *</td>
</tr>";
      echo " <tr>
           <td>Anno di produzione: </td>"; ?>
           <?php
           $data= date('Y');// con questa funzione recupero la data attuale
           echo "<td><input type='number' name='AnnoProduzione' value='$row[2]' min ='0' max='$data'></td>"; // in questo modo non posso mettere una data minore dell'attuale
            ?>
            <?php
            echo "</tr>
        <tr>
          <td>Anno di acquisto: </td>"; ?>
          <?php
          $data= date('Y');// con questa funzione recupero la data attuale
          echo "<td><input type='number' name='AnnoAcquisto' value ='$row[3]' min='0' max='$data' ></td>"; // in questo modo non posso mettere una data minore dell'attuale
           ?>
        <?php
      echo ' </tr>

        <tr>
          <td>Tipo di bicicletta: </td>';
          if($row[4]== 'corsa')
          echo "
          <td>Corsa<input type='radio' name='TipoBicicletta' value='corsa' onclick='active_corsa()'required checked> </br>
            Mountain Bike<input type='radio' name='TipoBicicletta' value='mountain bike' onclick='active_mountain()'required> *</td>
        </tr>
        <tr> ";
        else
          echo "<td>Corsa<input type='radio' name='TipoBicicletta' value='corsa' onclick='active_corsa()'required> </br>
            Mountain Bike<input type='radio' name='TipoBicicletta' value='mountain bike' onclick='active_mountain()'required checked> *</td>
        </tr>
        <tr> ";
        echo " <td>Peso (kg): </td>
          <td> <input type='number' name='Peso' value='$row[5]' min='0' step='any' disabled ></td>";
      echo '  </tr>
        <tr>
          <td>Dimensione delle ruote (Pollici): </td>
          <td><select name="DimensioneRuote" disabled>';
            if($row[6]=='26') echo '
              <option value="26" selected>26</option>
              <option value="27.5">27.5</option>
              <option value="29">29</option>
              </select></td>
              </tr>';
            if($row[6]=='27.5') echo '
              <option value="26" >26</option>
              <option value="27.5"selected>27.5</option>
              <option value="29">29</option>
              </select></td>
              </tr>';
            if($row[6]=='29') echo '
              <option value="26" >26</option>
              <option value="27.5">27.5</option>
              <option value="29" selected>29</option>
              </select></td>
              </tr>';
            if($row[6]==null) echo '
                <option value="26" >26</option>
                <option value="27.5">27.5</option>
                <option value="29" >29</option>
                </select></td>
                </tr>';

        echo "<input type='hidden' class='shiny-button' name='BiciDaModificare' value='$BiciDaModificare'> ";
        }

        echo "<tr>

        <td colspan='3'>";

        echo '<input type="submit" class="shiny-button" value="Modifica">';// <!-- una volta che clicco modifica ritorno all'esercio 8 e faccio l'update -->
        echo "</form>";

        echo '<form style="float:left;" method="POST" action="index.php?op=Profilo">';// <!-- con questa form torno all'esercizio 8 SENZA fare l'update -->
        echo '<input type="submit" class="shiny-button" value="Ho cambiato idea">';
         echo "</td>";
       echo ' </form>';


       echo "</td></tr>";
       echo "</table>";


?>
