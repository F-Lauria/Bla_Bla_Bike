<?php

$sql="SELECT Marca,Colore,Prezzo FROM FiltroAnnuncio WHERE Utente=$ID";
$res = $cid->query($sql)
  or die("Impossibile eseguire cencellazione! <br> Codice errore ". $cid->errno .": ". $cid->error ."<br>");

  if ($res->num_rows==0)
  echo "<table align='center'><td><a href='./index.php?op=Profilo&bkk=FiltroAnnuncio' class=\"shiny-button2\">Inserisci un filtro per gli annunci</a></td></table> </br>";
  else {

  while($row=$res->fetch_row()){

  echo '  <form class="" action="./index.php?op=Mercatino&bk=VisualizzaMercatino" method="post">
    <table align="center" class="bordi">
      <tr>
        <td><input type="radio" name="FiltroAnnuncio" value="SI"><i> Bicicletta di marca <b>'.$row[0].'</b>, di colore <b>'.$row[1].' </b>, con prezzo massimo di <b>'.$row[2].'</b></i></td>
      </tr>
      <tr>
        <td><input type="radio" name="FiltroAnnuncio" value="NO" checked> <i>Niente</i></td>
      </tr>
      <tr>
      <td colspan="2"> <input type="submit" name="ok" value="OK"> </td>
      </tr>
    </table>
    </form>';
  }
}
