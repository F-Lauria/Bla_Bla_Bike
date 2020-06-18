<form  name="InserisciProfilo" action="common/InserisciProfiloE.php" method="POST" onsubmit="qui ci vuole javascript">
	<table align="center" class='bordi'>
	<tr>
		<td>Nome :</td>
		<td><input 	type = "text"  name = "name" required>  </td>
	</tr>
  <tr>
    <td>Cognome :</td>
    <td><input 	type = "text"  name = "cognome" required> </td>
  </tr>
	<tr>
		<td>Data di nascita:</td>
		<?php
		$data=date('Y-m-d');
		echo "<td><input 	type='date'  name = 'dataN' max=$data required> </td>";
		?>
	</tr>
  <tr>
    <td>Luogo di nascita:</td>
    <td><input 	type = "text"  name = "luogoN" required> </td>
  </tr>
  <tr>
    <td>Città in cui vivi:</td>
    <td><input 	type = "text"  name = "citta" required> </td>
  </tr>
	<tr>
		<td>Inserisci e-mail:</td>
		<td><input 	type = "email"  name = "e-mail"required> </td>
	</tr>
  <tr>
    <td>Sesso:</td>
    <td><input 	type = "radio"  name = "sesso" value="Maschio" required>M /
    <input 	type = "radio"  name = "sesso" value="Femmina">F </td>
  </tr>

	<tr>
    <td>Il tuo livello:  </td>
    <td> <input 	type = "radio"  name = "Tipo_Profilo" value="Amatore" required>Amatore /
    <input 	type = "radio"  name = "Tipo_Profilo" value="Esperto">Esperto    </td>
  </tr>

	<tr><td></td></tr>
	<tr>
		<td colspan="2" align="center">
		    <input type="submit" class="shiny-button" value="ok"/>
		    <input type = "reset" class="shiny-button" value = "Cancella"/>
		</td>
	</tr>
	<tr>
		<td><p><i>Questi campi sono tutti obbligatori</i></p></td>
	</tr>
	</table>
</form>
