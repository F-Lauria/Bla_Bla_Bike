<form name=InserisciTappa method='get' action='common/InserisciTappaE.php'>
  <table align='center' class='bordi'>
    <tr><td>Lunghezza della tappa (km) * </td>
      <td><input name='Lunghezza' type='number' min='0'required></td> </tr>
    <tr><td>Tipo della tappa * </td>
        <td><select name='Tipo_Tappa'>
          <option value='pianeggiante'>pianura</option>
          <option value='salita'>salita</option>
          <option value='discesa'>discesa</option>
        </select></td></tr>
    <tr><td></td><td><input type='submit' class="shiny-button" value='ok'></td></tr>
    <tr>
      <td><p><i>I campi segnati con "*" sono obbligatori</i></p></td>
    </tr>
  </table>
</form>
