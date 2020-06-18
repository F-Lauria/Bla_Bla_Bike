<!DOCTYPE html>
<head></head>
<body>
<form   name="Iscriviti" action="common/IscrivitiE.php" method="POST" onsubmit="qui ci vuole javascript align="center"">
	<table align="center" class='bordi'>
	<tr>
		<td>Inserisci nome utente:</td>
		<td><input 	type = "text"  name = "username"required> *</td>
	</tr>

	<tr>
		<td>Password:</td>
		<td><input 	type = "password"  name = "pwd"required> *</td>
	</tr>
	<tr>
		<td>Ripeti assword:</td>
		<td><input 	type = "password"  name = "pwd1"required> *</td>
	</tr>

		<td colspan="2" align="center">
		    <input type="submit" class="shiny-button" value="ok"/>
		    <input type = "reset" class="shiny-button" value = "Cancella"/>
		</td>
	</tr>
	<tr>
		<td><p><i>I campi segnati con "*" sono obbligatori</i></p></td>
	</tr>
	</table>
</form>
</body>
