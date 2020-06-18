  <b align='center'>Abbiamo bisogno di alcuni dati: </b>
  <br/><br/>
<form  action="common/InserisciUscitaE.php" method="GET">

  <table align='center' class="bordi">
    <tr>
      <td>Immetti un titolo: </td><td> <input type="text" name="titolo" required> *</td>
    </tr>
    <tr>
      <td>Tipo di uscita:</td>
      <td><select name='TipoUscita'required>
        <option name='corsa' value='corsa'>Bici da corsa</option>
        <option name='mountainbike' value='mountain bike'>Mountain bike</option>
      </select> *</td>
    </tr>
    <tr>
      <td>Livello di difficoltà:</td>
      <td><select name='LivelloDifficoltà'required>
        <option name='basso' value='basso'>Basso</option>
        <option name='medio' value='medio'>Medio</option>
        <option name='alto' value='alto'>Alto</option>
      </select> * </td>
    </tr>
    <tr>
      <td>Livello di visibilità:</td>
      <td><select name='LivelloVisibilità' onclick="//bisogna metter javascript per dire che si intende" required>
        <option name='pubblica' value='pubblica'>Pubblica</option>
        <option name='privata' value='privata'>Privata</option>
      </select> *</td>
    </tr>
    <tr>
      <td>Durata (minimo 8 ore): </td>
      <td><input type="number" name="Durata" min='8'required> *</td>
    </tr>
    <tr>
      <td>Lunghezza del percorso (km): </td>
      <td><input type="number" name="Distanza" min='0' required> *</td>
    </tr>
    <tr>
      <td>Dislivello in metri: </td>
      <td><input type="number" name="Dislivello" min='0' required> *</td>
    </tr>
    <tr>
      <td>Orario di ritrovo: </td>
      <td><input type="time" name="Ora" required> *</td>
    </tr>
    <tr>
      <td>Data: </td>

      <?php
      $data= date('Y-m-d');// con questa funzione recupero la data attuale
      echo "<td><input type='date' name='Data' min=$data required> *</td>"; // in questo modo non posso mettere una data minore dell'attuale
       ?>
    </tr>
    <tr>
      <td>Luogo: </td>
      <td><input type="text" name="Luogo" required> *</td>
    </tr>
    <tr>
      <td>Note: </td>
      <td><input type="textarea" name="Note" ></td>
    </tr>
    <tr>
      <td colspan="2"><input type='submit'class="shiny-button" value='ok'>
      <input type='reset' class="shiny-button" value='cancel'></td>
    </tr>
    <tr>
      <td colspan="2"><a href="index.php?op=TueUscite" class="shiny-button">indietro</a></td>
    </tr>
    <tr>
      <td><p><i>I campi segnati con "*" sono obbligatori</i></p></td>
    </tr>
  </table>

</form>
<br>
