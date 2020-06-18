

<?php

$sql="SELECT Durata,Livello_di_difficolta,Tipo_Uscita,Luogo FROM FiltroUscita WHERE Utente=$ID";
$res = $cid->query($sql)
  or die("Impossibile eseguire cencellazione! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");

  if ($res->num_rows==0)
  echo "<table align='center'><td><a href='./index.php?op=Profilo&bkk=FiltroUscita' class=\"shiny-button2\" >Inserisci un filtro per le uscite</a></td></table> </br>";
  else {

  while($row=$res->fetch_row()){

  echo '  <form class="" action="./index.php?op=Uscite&bk=Uscite" method="POST">
    <table align="center" class="bordi">
      <tr>
        <td><input type="radio" name="FiltroUscita" value="SI"><i> Uscita con durata massima di <b>'.$row[0].' ore</b>, livello di difficoltà <b>'.$row[1].' </b>, con tipo di bici <b>'.$row[2].'</b> a <b>'.$row[3].'</b></i></td>
      </tr>
      <tr>
        <td><input type="radio" name="FiltroUscita" value="NO" checked> <i>Niente</i></td>
      </tr>
      <tr>
      <td colspan="2"> <input type="submit" name="ok" value="OK"> </td>
      </tr>
    </table>
    </form>';
  }
}


?>
