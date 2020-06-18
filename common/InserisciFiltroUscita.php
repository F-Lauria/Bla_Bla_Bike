<form class="" action="common/InserisciFiltroUscitaE.php" method="GET">
  <table align="center" class='bordi'>
    <tr>
      <td colspan="3"> Definisci il tuo filtro per le  <b>uscite</b> <br></td>
    </tr>
  <tr>
    <td>Durata massima:</td>
    <td><input type="number" name="DurataMax" value="" min="8" required ></td>
  </tr>
  <tr>
  <td>Livello di difficoltà</td>
  <td><select name='LivelloDifficoltà'required>
    <option name='basso' value='basso'>Basso</option>
    <option name='medio' value='medio'>Medio</option>
    <option name='alto' value='alto'>Alto</option>
  </select> </td>
</tr>
  <tr>
    <td>Tipo di uscita:</td>
    <td><select name='TipoUscita'required>
      <option name='corsa' value='corsa'>Bici da corsa</option>
      <option name='mountainbike' value='mountain bike'>Mountain bike</option>
    </select> </td>
  </tr>
  <tr>
    <td>Luogo: </td>
    <td><input type="text" name="Luogo" required> </td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" class="shiny-button" value="OK">
      <input type="reset"  class="shiny-button" value="cancel"></td>
  </tr>

</form>
</table>
