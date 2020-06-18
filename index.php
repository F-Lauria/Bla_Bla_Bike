<?php


include_once ("./common/connection.php");
include_once ("./common/file.php");



$operation="Home";
if (isset($_GET["op"]))  $operation= $_GET["op"];

$opBike= '';
if (isset($_GET["bk"])) $opBike= $_GET["bk"];

 $opTapp='';
 if (isset($_GET["tpp"])) $opTapp= $_GET["tpp"];

 $opAnnuncio='';
 if(isset($_GET["opann"])) $opAnnuncio=$_GET["opann"];

 $opRimuovi='';
 if(isset($_GET["oprim"])) $opRimuovi=$_GET["oprim"];

 $opPartecipa='';
 if(isset($_GET["oppa"])) $opPartecipa=$_GET["oppa"];

 $opBkk='';
 if(isset($_GET["bkk"])) $opBkk=$_GET["bkk"];

 $Page='';
 if(isset($_GET["page"])) $Page=$_GET["page"];

 $Page2='';
 if(isset($_GET["pg"])) $Page=$_GET["pg"];

//if(isset($_GET['esci'])&&$_GET['esci']=='on') session_destroy();
 ?>





<!DOCTYPE html>
<html>
<head>
    <title>Bla bla bike</title>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-8">
    <meta name="author1" content="Sebastian Martini">
    <meta name="author2" content="Francesco Lauria">
    <meta name="topics"	content="Bla bla bike">
    <script type="text/javascript" src="js/validate.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/stile.css">
    <link rel="" href="">
</head>
<body>


     <a class='logo' href="index.php"><img src="img/blablacar_LOGO_bearb.png" width="90%" height="90%" alt="Logo"></a>



  <div class="titolo">
      <h4>IL SITO DI CHI AMA LA BICI</h4>
    </div>
    <br>



<br>
  <div id='menu' align="right" style='position: relative; top: 65px;'>
  	<br/>


<?php

session_start();


if(!isset($_SESSION['Utente'])){
echo '<table class="menu">';
  echo "<tr>";

    if ($operation=="Home")
       echo "<td><a href=\"index.php?op=Home\" class=\"button aqua\">Home</a> </td>";

     else
       echo "<td><a href=\"index.php?op=Home\" class=\"button aqua\">Home</a></td> ";

    if ($operation=="Accedi")
      echo "<td><a href=\"index.php?op=Accedi\" class=\"button aqua\">Accedi</a></td> ";

    else
      echo "<td><a href=\"index.php?op=Accedi\" class=\"button aqua\">Accedi</a> </td>";

    if ($operation=="Iscriviti")
      echo "<td><a href=\"index.php?op=Iscriviti\" class=\"button aqua\">Iscriviti</a></td> ";

    else
      echo "<td><a href=\"index.php?op=Iscriviti\" class=\"button aqua\">Iscriviti</a></td> ";

      echo "</tr>";
      echo "</table>";
}
// da qui in poi siamo nel nostro account

else{
  echo "<table class='menu'>";
  echo "<tr>";
  //con queste due variabili ho la possibilità di navigare nella pagina sempre usando lo stesso ID
  $Nome_Utente=$_SESSION['Nome'];
  $ID=RecuperaID($cid,$Nome_Utente);
  if ($operation=="Home"){
     echo "<td><a href=\"index.php?op=Home\" class=\"button aqua\" >  Home </a></td> ";
   }
   else{
     echo "<td><a href=\"index.php?op=Home\" class=\"button aqua\">Home</a> </td>";
      }

   if ($operation=="Profilo"){
    echo "<td><a href=\"index.php?op=Profilo\" class=\"button aqua\">";
    echo RestituisciNome_Utente($cid,$ID);
    echo "</a></td> ";
  }
  else{
      echo "<td><a href=\"index.php?op=Profilo\" class=\"button aqua\">";
      //$Nome_Utente= $_SESSION['Nome'];
      echo RestituisciNome_Utente($cid,$ID);
      echo "</a></td>";
  }
  if ($operation=="TueUscite")
     echo "<td><a href=\"index.php?op=TueUscite\" class=\"button aqua\">Le tue uscite</a></td> ";

   else
     echo "<td><a href=\"index.php?op=TueUscite\" class=\"button aqua\">Le tue uscite</a></td> ";

   if ($operation=="TuoiAnnunci")
      echo "<td><a href=\"index.php?op=TuoiAnnunci\" class=\"button aqua\">I tuoi annunci</a></td> ";

    else
      echo "<td><a href=\"index.php?op=TuoiAnnunci\" class=\"button aqua\">I tuoi annunci</a></td> ";

    if ($operation=="Richieste"){
        $NumNotifiche= RecuperaNumNotifiche($cid,$ID);
       echo "<td><a href=\"index.php?op=Richieste\" class=\"button aqua\">Richieste[$NumNotifiche]</a></td> ";
     }
     else{
       $NumNotifiche= RecuperaNumNotifiche($cid,$ID);
       echo "<td><a href=\"index.php?op=Richieste\" class=\"button aqua\">Richieste[$NumNotifiche]</a> </td>";
     }
    if ($operation=="Esci")
       echo "<td><a href=\"index.php?op=Esci\" onclick='return ValidaUscita()'\" class=\"button aqua\">Esci</a></td> ";

     else
       echo "<td><a href=\"index.php?op=Esci\" onclick='return ValidaUscita()'\" class=\"button aqua\">Esci</a></td> ";
     echo"</tr></table>"; // qui chiudo i tasti menu
}
 ?>
</div>

<div class="corpo" >
	<br/>

  <?php

  switch ($operation) {
		 case "Accedi":
			 echo "<b>Accedi al sito</b>";
			 include "common/Accedi.php";
			 break;

		case "Iscriviti":
			 echo "<b>Iscriviti al sito</b>";
			 include "common/Iscriviti.php";
			 break;
    case "msg": //visualizza un messaggio di errore nel
                //caso non sia stato possibile registrare l'utente
        echo base64_decode($_GET["msg"]);
        break;
    case "InserisciProfilo": //visualizza la form di inserimento dati Profilo
      echo '<h3>Benvenuto in Bla Bla Bike! Compila il tuo profilo: <h3><br/>';
      include 'common/InserisciProfilo.php';
      break;

    case 'TueUscite':
      echo '<h3>Le uscite che hai organizzato: </h3>';


      if(isset($_GET["tpp"]) && $_GET["oprim"]=="RimuoviUscita"){
        $UscitaDaRimuovere=$_GET["tpp"];
        RimuoviUscita($cid,$UscitaDaRimuovere);
      }

      if($opBike=='uscite')
        include 'common/InserisciUscita.php';
      else{
          VisualizzaUsciteOrganizzateDate($cid,$ID);
      }
        echo "<a href=\"./index.php?op=TueUscite&bk=uscite\" class=\"shiny-button\">Inserisci un'uscita</a> ";

echo "<br>";
        echo '<h3>Le uscite a cui parteciperai: </h3>';
        echo "<table align='center'>";
        $data=date('Y-m-d');
        VisualizzaUsciteAcuiPartecipi($cid,$ID,$data);
        echo "</table>";
        echo '<h3>Le uscite a cui hai partecipato: </h3>';
        echo "<table align='center'>";
        VisualizzaUsciteAcuiHaiPartecipato($cid,$ID,$data);
        echo "</table>";


        echo "</table>";
      break;

    case 'InserisciTappe':
      echo "<h3>Inserisci una tappa per l'uscita: ".strtoupper ($_SESSION['TitoloUscita'])." </h3><br/>";
        echo '<p><i>(!) La somma della lunghezza delle tappe deve essere uguale alla lunghezza totale dell\'uscita ('.$_SESSION["LunghezzaUscita"].'km).</i></p>';
       visualizzaTappe($cid,$_SESSION['ID_Uscita']);




      if($opBkk=='Not'){
        $LunghezzaUscita=$opTapp;
        echo "Non puoi inserire la tappa poichè la lunghezza totale del percorso ($LunghezzaUscita Km) è inferiore alla somma delle tappe.</br>";
        echo  "<a href=\"./index.php?op=InserisciTappe\" class=\"shiny-button\">Inserisci tappa</a> <br/>";
      }
      else{
        $sommaTappe= RecuperaSommaLunghezzaTappe($cid,$_SESSION["ID_Uscita"]);

        if($sommaTappe<$_SESSION["LunghezzaUscita"]){
          include 'common/InserisciTappa.php';
        }

        echo  "<a href=\"./index.php?op=TueUscite\" class=\"shiny-button\">Fine</a> <br/>";
      }


    case 'Tappe':
        if(isset($_GET["tpp"])&& isset($_GET["bk"])&& isset($_GET["bkk"])){
          $_SESSION['ID_Uscita']=$_GET["tpp"];
          $_SESSION['TitoloUscita']=$_GET["bk"];
          $_SESSION["LunghezzaUscita"]=$_GET['bkk'];
          echo "<h3>Le tappe della tua uscita: ".strtoupper($_SESSION['TitoloUscita'])."</h3><br/>";

          visualizzaTappe($cid,$_SESSION['ID_Uscita']);

          $sommaTappe= RecuperaSommaLunghezzaTappe($cid,$_SESSION["ID_Uscita"]);
          if($sommaTappe<$_SESSION["LunghezzaUscita"]){
              echo  "<a href=\"./index.php?op=InserisciTappe\" class=\"shiny-button\">Inserisci tappa</a> <br/>";
          }
          else {
            echo  "<a href=\"./index.php?op=TueUscite\" class=\"shiny-button\">Indietro</a> <br/>";
          }
      }


      break;

      case 'TuoiAnnunci':
        if($opBike=='annunci'){
          echo "Quale bicicletta vorresti vendere?";
          VisualizzaBiciclettePerAnnuncio($cid,$ID);
        }
        else if ($opBike!='scelto'){
          echo "<h3>Gli annunci che hai pubblicato:</h3> </br>";
        VisualizzaAnnunciDaTePubblicati($cid,$ID);
          if(isset($_GET["opann"])){
            $AnnuncioDaEliminare=$_GET["opann"];
            EliminaAnnuncio($cid,$AnnuncioDaEliminare);
          }
      }

        if(isset($_GET["opann"]) && $opBike=='scelto'){
          $_SESSION["BiciAnnuncio"]=$_GET["opann"];
          $BiciAnnuncio=$_SESSION["BiciAnnuncio"]; // in questa variabile ho l'id bike corrispondente alla bici inserita nell'annuncio
          echo "<h2> Compila il tuo annuncio per la bici:</h2> <br>";
          VisualizzaBiciclettaSelezionataPerAnnuncio($cid,$BiciAnnuncio);
          echo "<br>";
          include 'common/InserisciAnnuncio.php';

        }
        else
          echo "<a href=\"./index.php?op=TuoiAnnunci&bk=annunci\" class=\"shiny-button\">Inserisci un annuncio</a> <br/>";
        break;




    case 'Profilo':
      //echo "<div id='DatiProfilo>";
      echo "<table align='center'>
            <tr><td><img src='img/Logo_Utente.png' style ='height : 25px; width : 25px;'></img></td><td><h3>I tuoi dati:</h3></td></tr></table>";
      VisualizzaProfilo($cid,$ID);
      //echo "</div>";
      echo "<table align='center'><tr><td><img src='img/Logo_Bici.png' style ='height : 35px;' ></img></td><td><h3>Le tue biciclette:</h3></td></tr></table>";

      if($opBike=='bike'){
        echo "<h4>Inserisci le informazioni della bici che vuoi inserire: </h4>";
        include 'common/InserisciBicicletta.php';
      }
      else{
              VisualizzaBiciclette($cid,$ID);
              echo "<br>";
              echo "<a href=\"./index.php?op=Profilo&bk=bike\" class=\"shiny-button \">Inserisci bicicletta</a> <br/>";
      }

      echo "<h3>I Ciclisti che segui: </h3><br/>";
      $_SESSION['MioIdCiclista']=$ID;
      /*$PaginaCorrente2=1;
      if($Page2!="")
        $PaginaCorrente2=$Page2;*/
      VisualizzaAmici($cid,$ID);

      echo "<h3>I tuoi filtri: </h3><br/>";
      if ($opBkk=="FiltroAnnuncio" || $opBkk=="FiltroUscita"){
            if($opBkk=="FiltroAnnuncio"){
              $_SESSION["UtenteFiltro"]=$ID;
              include 'common/InserisciFiltroAnnuncio.php';
              echo "<a href='index.php?op=Profilo' class=\"shiny-button \"> Torna indietro </a>";

            }

            if($opBkk=="FiltroUscita"){
              $_SESSION["UtenteFiltro"]=$ID;
              include 'common/InserisciFiltroUscita.php';
              echo "<a href='index.php?op=Profilo' class=\"shiny-button \"> Torna indietro </a>";

            }
      }
      else{
        if($opBike=="ModificaFiltroAnnuncio" && isset($_GET["oppa"])){
          $FiltroAnnuncioDaModificare=$_GET["oppa"];
          include 'common/ModificaFiltroAnnuncio.php';
          //echo "<a href='index.php?op=Profilo'> Torna indietro </a>";
          break; // con questo break permetto di visualizzare correttamente il form di modifica filtro annuncio
        }
        if($opBike=="ModificaFiltroUscita" && isset($_GET["oppa"])){
          $FiltroUscitaDaModificare=$_GET["oppa"];
          include 'common/ModificaFiltroUscita.php';
          //echo "<a href='index.php?op=Profilo'> Torna indietro </a>";
        }

        else
          VisualizzaFiltri($cid,$ID);

      }
      break;

    case 'Modifica':

      if($_GET["bk"]=="EliminaProfilo"){ // con questo if elimino profilo piu utente
         $ProfiloDaEliminare=$_GET["tpp"];
         EliminaProfilo($cid,$ProfiloDaEliminare);
      }

      if($_GET["bk"]=="ModificaStato"){
          $Annuncio=$opAnnuncio;
          $Stato=$opBkk;
          ModificaStatoAnnuncio($cid,$Annuncio,$Stato);
      }
      if ($_GET['bk']== 'EliminaBike'){
        $BiciDaEliminare=$_GET['tpp'];
        EliminaBicicletta($cid,$BiciDaEliminare);
      }
      if ($_GET['bk']== 'ModificaBike'){
        echo "<h3>Modifica i dati della tua bicicletta.</h3>";
        $BiciDaModificare=$_GET['tpp'];
        include 'common/ModificaBicicletta.php';
      }
      if ($_GET['bk']== 'ModificaProfilo'){
        echo "<h3>Modifica i dati di ".$_GET['tpp'].":</h3>";
        include 'common/ModificaProfilo.php';
      }
      break;

      case 'xml':

          $TitoloXML="";
          if (isset($_GET["xml1"]))  $TitoloXML= $_GET["xml1"];
          $TipoUscitaXML="";
          if (isset($_GET["xml2"]))  $TipoUscitaXML= $_GET["xml2"];
          $LivelloDifficoltaXML="";
          if (isset($_GET["xml3"]))  $LivelloDifficoltaXML= $_GET["xml3"];
          $DurataXML="";
          if (isset($_GET["xml4"]))  $DurataXML= $_GET["xml4"];
          $LunghezzaXML="";
          if (isset($_GET["xml5"]))  $LunghezzaXML= $_GET["xml5"];
          $DislivelloXML="";
          if (isset($_GET["xml6"]))  $DislivelloXML= $_GET["xml6"];
          $OraXML="";
          if (isset($_GET["xml7"]))  $OraXML= $_GET["xml7"];
          $DataXML="";
          if (isset($_GET["xml8"]))  $DataXML= $_GET["xml8"];
          $LuogoXML="";
          if (isset($_GET["xml9"]))  $LuogoXML= $_GET["xml9"];


          echo "<h4>Copia e incolla il file XML relativo all'uscita: ".strtoupper($TitoloXML)."</h4>";
          include 'common/VisualizzaXML.php';
          echo "<br>";
          echo "<a href='index.php?op=TueUscite' class=\"shiny-button\"> Torna indietro </a>";
          break;

      case "Ciclisti":
          echo "<h3>Tutti i ciclisti di Bla Bla Bike: </h3>";
          $_SESSION['MioIdCiclista']=$ID;
          $PaginaCorrente=1;
          if($Page!="")
            $PaginaCorrente=$Page;
          VisualizzaCiclisti($cid, $ID,$PaginaCorrente);
          echo "<a href='index.php?op=Home'class=\"shiny-button \"> Torna alla home </a>";
          break;

    case 'Richieste':
      echo "<h3>Le richieste di partecipazione: </h3></br>";
      VisualizzaNotifiche($cid,$ID);
      echo "<a href='index.php' class=\"shiny-button \">Torna Alla Home</a>";

      break;

    case "Esci": //consente di uscire dal proprio account
        session_destroy();
        header('Location:index.php');


	  default:

      /*if($operation!="Mercatino")
      echo "<div class='inside2'>";*/

       if($operation=="Uscite"){
          echo "<h1>Le Uscite di Bla Bla Bike</h1> <br/>";

         if(isset($_SESSION['Utente'])){

           //echo "<b>Seleziona un filtro: </b>";
           include 'common/VisualizzaFiltriUscite.php';

         if($operation=="Uscite" && $opBike=="Uscite"){
           echo "<br>";

             if(!isset($_POST["FiltroUscita"]) || isset($_POST["FiltroUscita"]) && $_POST["FiltroUscita"]=='NO'){
             $data= date('Y-m-d');
             VisualizzaUsciteHome($cid, $data, $ID);

         }
          else{
            if(isset($_POST["FiltroUscita"]) && $_POST["FiltroUscita"]=="SI"){
            $data= date('Y-m-d');
            VisualizzaUsciteFiltroHome($cid, $data, $ID);
          }
          }
           echo "<a href=\"index.php?op=Home\" class=\"shiny-button \">Torna alla home</a> <br/>";
         }
         if($operation=="Uscite" && (isset($_GET["tpp"]))  && (isset($_GET["opann"]))){
           $ID_Uscita=$_GET["tpp"];
           $TitoloUscita=$_GET["opann"];
           echo "<br>";
           VisualizzaUscitaSelezionata($cid,$ID_Uscita, $TitoloUscita);
             echo "<h3>Le tappe dell'uscita: </h3><br/>";
           include "common/VisualizzaTappeHome.php";
           if($opPartecipa=='BiciDaSelezionare'){
             if(isset($_GET['bkk'])){
               $opBkk=$_GET['bkk'];
               echo "<h3>Parteciparei con la bici: </h3>";
               VisualizzaBiciclettaSelezionataPerUscita($cid, $opBkk);
               InserisciPartecipante($cid,$ID,$ID_Uscita,$opBkk);
               echo "<br><h2>Richiesta di partecipazione avvenuta con successo!</h2><p><i>Se l'organizzatore dell'uscita acceterà la tua partecipazione, potrai vederla sul tuo profilo!</i></p>";
                echo "<a href=\"index.php\" class=\"shiny-button \">Torna alla Home</a> <br/>";
            }
            else{
              echo "<h3>Scegli la bicicletta con cui vuoi partecipare:</h3></span>";
               if (isset($_SESSION['TipoUscita'])) $Tipo=$_SESSION['TipoUscita'];
              VisualizzaBiciclettePerUscita($cid,$ID, $ID_Uscita, $TitoloUscita, $Tipo);
            }
           }
             else echo "<a href=\"index.php?op=Uscite&tpp=$ID_Uscita&opann=$TitoloUscita&oppa=BiciDaSelezionare\" class=\"shiny-button\">Partecipa!</a>";
         }
          break;
       }
         else{
           echo "<b>Accedi al sito:</b>";
           include "common/Accedi.php";
           echo "<br>";
           echo "<a href=index.php?op=Iscriviti class=\"shiny-button\"> Oppure iscriviti </a>";
           break;
         }
       }
       else{
         if($operation!="Mercatino"&&$opBike!="Uscite")
         echo "<a href=\"index.php?op=Uscite&bk=Uscite\" class=\"buttonHome \">Cerca Uscite in bicicletta</a> <br/>";
       }

echo "<br>";
echo "<br>";

      if($operation=="Mercatino"){
        echo "<h1 align='center'>Benvenuto nel Mercatino</h1> ";
        if(!isset($_SESSION['Utente'])){
          VisualizzaMercatino($cid);
          echo "<div align='center'>";
          echo "<a href=\"index.php?op=Home\" class=\"shiny-button \">Torna alla home</a>";
          echo "</div>";
        }


          else {
        include 'common/VisualizzaFiltriAnnunci.php';

        if ($operation=="Mercatino" && $opBike=="VisualizzaMercatino"){
          echo "<br>";
          if(!isset($_POST['FiltroAnnuncio']) || isset($_POST['FiltroAnnuncio'])&& $_POST['FiltroAnnuncio']=='NO'){
            VisualizzaMercatino($cid);
          }
          else {
            if(isset($_POST['FiltroAnnuncio']) &&$_POST['FiltroAnnuncio']=='SI')
              VisualizzaMercatinoFiltro($cid, $ID);
          }
          echo "<div align='center'>";
          echo "<a href=\"index.php?op=Home\" class=\"shiny-button \">Torna alla home</a>";
          echo "</div>";
          }
      }

      echo "<br>"; // questo porta a capo tra il mercatino e la visualizzazione del contatto
        if($operation=="Mercatino" && $opBike=="VisualizzaMercatino" && isset($_GET["bkk"]) && isset($_GET["opann"])){
            $Venditore=$_GET["bkk"];
            $Annuncio=$_GET["opann"];
            VisualizzaAnnuncioSelezionato($cid,$Annuncio);
            echo "<br>";
            echo "<div class='inside align='center' fontcolor='red'>";
            echo "<b>Ecco il contatto per comprare la bicicletta</b>";
            echo "</div>";
            VisualizzaContattoVenditore($cid,$Venditore);
        }
            break;
    }

      else{

          echo "<a href=\"index.php?op=Mercatino&bk=VisualizzaMercatino\" class=\"buttonHome \">Entra nel Mercatino</a> <br/>";
        }

echo "<br>";
echo "<br>";

      if(isset($_SESSION['Utente'])){
        if($operation=="Ciclisti")
            echo "<a href=\"index.php?op=Ciclisti\" class=\"buttonHome \">Gli altri ciclisti</a> <br/>";
        else
            echo "<a href=\"index.php?op=Ciclisti\" class=\"buttonHome \">Gli altri ciclisti</a> <br/>";
      }
	}


   ?>
 </div> <!-- questo div chiude tutto il CORPO del sito -->

 </div>
</body>
</html>
