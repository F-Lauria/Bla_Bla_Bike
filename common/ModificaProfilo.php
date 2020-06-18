<?php
$sql="SELECT Nome,Cognome,Data_Nascita,Luogo_Nascita,Citta,E_mail,Sesso,Tipo_Profilo
 FROM Profilo where ID_Utente=(SELECT ID_Utente FROM Utente WHERE ID_Utente= '$ID')";

 $res=$cid->query($sql) Or die ("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
. ": " . $cid->error) . "</p>";

echo "<table align='center'>";

 while($row=$res->fetch_row()){

   echo '<form style="float:left;"  action="common/ModificaProfiloE.php" onsubmit="return ConfermaModificaProfilo()" method="POST">';

   echo "<table align='center' class='bordi'>"; // in questa tabella nel value utilizzo row[] perchè in questo modo mi stampa i valori di default e posso vederli prima di modificarli
   echo "<tr><th>Nome</th>
         <td><input type='text' name='nome' value='$row[0]'></td>
         </tr>";
   echo "<tr><th>Cognome</th>
         <td><input type='text' name='cognome' value='$row[1]'></td>
         </tr>";
   echo "<tr><th>Data di nascita</th>
         <td><input type='date' name='Data_Nascita' value='$row[2]'></td>
         </tr>";
  echo "<tr><th>Luogo di nascita</th>
        <td><input type='text' name='Luogo_Nascita' value='$row[3]'></td>
        </tr>";
  echo "<tr><th>Città</th>
        <td><input type='text' name='Citta' value='$row[4]'></td>
        </tr>";
  echo "<tr><th>Email</th>
              <td><input type='email' name='Email' value='$row[5]'></td>
              </tr>";
  echo "<tr><th>Sesso</th>";
  if ($row[6]=='Maschio')
    echo "<td><input 	type = 'radio'  name = 'sesso' value='Maschio' checked>M /
      <input 	type = 'radio'  name = 'sesso' value='Femmina'>F </td>
      </tr>";
    else
      echo "<td><input 	type = 'radio'  name = 'sesso' value='Maschio' >M /
        <input 	type = 'radio'  name = 'sesso' value='Femmina'checked>F </td>
        </tr>";
  echo "<tr><th>Il tuo livello</th>";
  if($row[7]=='amatore')
    echo "<td> <input 	type = 'radio'  name = 'Tipo_Profilo' value='amatore' required checked>Amatore /
        <input 	type = 'radio'  name = 'Tipo_Profilo' value='esperto'>Esperto    *</td>
        </tr>";
  else
  echo "<td> <input 	type = 'radio'  name = 'Tipo_Profilo' value='amatore' required >Amatore /
      <input 	type = 'radio'  name = 'Tipo_Profilo' value='esperto'checked>Esperto    *</td>
      </tr>";
      }

   echo "<tr><td colspan='4'>";

   echo '<input type="submit" class="shiny-button" value="Modifica">';// <!-- una volta che clicco modifica ritorno all'esercio 8 e faccio l'update -->
   echo "</form>";
   echo '<form style="float:left;" method="POST" action="index.php?op=Profilo">';// <!-- con questa form torno all'esercizio 8 SENZA fare l'update -->
   echo '<input type="submit" class="shiny-button" value="Ho cambiato idea">';
  echo ' </form>';

  echo "</td></tr>";
  echo "</table>";












 ?>
