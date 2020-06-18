<form class="" action="common/InserisciFiltroAnnuncioE.php" method="get">
  <table align="center" class='bordi'>
    <tr>
      <td colspan="3"> Definisci il tuo filtro per gli  <b>annunci</b> <br></td>
    </tr>
    <tr>
      <td>Marca: </td><td><select name="Marche" required>
        <option name='Marca' value='Bianchi'>Bianchi</option>
        <option name='Marca' value='Rossignoli'>Rossignoli</option>
        <option name='Marca' value='BeTween'>BeTween</option>
        <option name='Marca' value='Scott'>Scott</option>
        <option name='Marca' value='Specialized'>Specialized</option>
        <option name='Marca' value='Cannondale'>Cannondale</option>
      </select></td>
    </tr>
    <tr>
      <td>Colore: </td><td><select name='Colore'required>
          <option value='Rosso'>Rosso</option>
          <option value='Blu'>Blu</option>
          <option value='Nero'>Nero</option>
          <option value='Bianco'>Bianco</option>
          <option value='Giallo'>Giallo</option>
          <option value='Verde'>Verde</option>
          <option value='Arancione'>Arancione</option>
          <option value='Viola'>Viola</option>
          <option value='Rosa'>Rosa</option>
      </select></td>
    </tr>
    <tr>
      <td>Prezzo massimo: </td><td><input type="number" name="Prezzo"></td>
    </tr>
    <tr>
      <td colspan="3"><input type="submit" class="shiny-button" value="OK">
        <input type="reset" class="shiny-button" value="cancel"></td>
    </tr>
  </table>

</form>
