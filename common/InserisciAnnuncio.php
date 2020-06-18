<form  action="common/InserisciAnnuncioE.php" method="GET">
  <table align="center" class="bordi">
    <tr>
      <td>Titolo dell'annuncio:</td>
      <td> <input type="text" name="titolo" required> *</td>
    </tr>

    <tr>
      <td>Prezzo della bici:</td>
      <td> <input type="number" name="prezzo" min='0' required> *</td>
    </tr>
    <tr>
      <td>Descrizione:</td>
      <td><input type="text"  name="descrizione" ></td>
    </tr>
    <tr>
    <td><input type="hidden" name="stato" value="In vendita"></td>
    </tr>
      <td colspan="2"><input type="submit" class="shiny-button"  name="Ok" value="Ok">
      <input type="reset" name="Cancella"  class="shiny-button" value="Cancella"></td>
    </tr>
    <tr>
      <td><p><i>I campi segnati con "*" sono obbligatori</i></p></td>
    </tr>
  </table>

</form>
