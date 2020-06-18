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


<form name="InserisciBici" action="common/InserisciBiciclettaE.php" method="GET">
  <table align='center' class='bordi'>
    <tr>
      <td>Marca:</td><td> <select name="Marche" required>
        <option name='Marca' value='Bianchi'>Bianchi</option>
        <option name='Marca' value='Rossignoli'>Rossignoli</option>
        <option name='Marca' value='BeTween'>BeTween</option>
        <option name='Marca' value='Scott'>Scott</option>
        <option name='Marca' value='Specialized'>Specialized</option>
        <option name='Marca' value='Cannondale'>Cannondale</option>
      </select>
      <input type='button' value='altro' onclick='active_marca();'>
      <input type="text" name="Altro" disabled required>
     * </td>
    </tr>
    <tr>
      <td>Colore: </td>
      <td><select name='Colore'required>
          <option value='Rosso'>Rosso</option>
          <option value='Blu'>Blu</option>
          <option value='Nero'>Nero</option>
          <option value='Bianco'>Bianco</option>
          <option value='Giallo'>Giallo</option>
          <option value='Verde'>Verde</option>
          <option value='Arancione'>Arancione</option>
          <option value='Viola'>Viola</option>
          <option value='Rosa'>Rosa</option>
      </select> *</td>
    </tr>
    <tr>
       <td>Anno di produzione: </td>
       <?php
       $data= date('Y');// con questa funzione recupero la data attuale
       echo "<td><input type='number' name='AnnoProduzione'  min ='0' max='$data'></td>"; // in questo modo non posso mettere una data minore dell'attuale
        ?>
    </tr>
    <tr>
      <td>Anno di acquisto: </td><?php
      $data= date('Y');// con questa funzione recupero la data attuale
      echo "<td><input type='number' name='AnnoAcquisto' min='0' max='$data' ></td>"; // in questo modo non posso mettere una data minore dell'attuale
       ?>

    </tr>

    <tr>
      <td>Tipo di bicicletta: </td>
      <td>Corsa<input type="radio" name="TipoBicicletta" value='corsa' onclick='active_corsa()'required> </br>
        Mountain Bike<input type="radio" name="TipoBicicletta" value='mountain bike' onclick='active_mountain()'required> *</td>
    </tr>
    <tr>
      <td>Peso (kg): </td>
      <td><input type="number" name="Peso" min='0' step='any' disabled ></td>
    </tr>
    <tr>
      <td>Dimensione delle ruote (Pollici): </td>
      <td><select name="DimensioneRuote" disabled>
        <option value="26">26</option>
        <option value="27.5">27.5</option>
        <option value="29">29</option>



      </select></td>
    </tr>
    <tr>
      <td align='right'><input type='submit' class="shiny-button" value='ok'></td>
      <td align='left'><input type='reset' class="shiny-button" value='cancel'></td>

    </tr>
    <tr>
      <td colspan="4"><a href="index.php?op=Profilo" class="shiny-button">indietro</a></td>
    </tr>
    <tr>
      <td><p><i>I campi segnati con "*" sono obbligatori</i></p></td>
    </tr>
  </table>

</form>
