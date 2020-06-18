<?php
echo "<textarea rows='32' cols='50' readonly>
      <? XML version='1.0' ?>
      <!DOCTYPE USCITA SYSTEM 'Uscita.dtd' >

      <USCITA titolo='$TitoloXML'>

          <LUOGO>
              $LuogoXML
          </LUOGO>

          <TIPO_DI_USCITA tipo='$TipoUscitaXML'/>

          <LIVELLO_DI_DIFFICOLTA livello='$LivelloDifficoltaXML'/>

          <DURATA>
              $DurataXML ore
          </DURATA>

          <LUNGHEZZA>
              $LunghezzaXML km
          </LUNGHEZZA>

          <DISLIVELLO>
              $DislivelloXML m
          </DISLIVELLO>

          <DATA ora='$OraXML'>
              $DataXML
          </DATA>

      </USCITA>
      </textarea>";
 ?>
