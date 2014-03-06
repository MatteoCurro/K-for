<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("header.php");

?>

<div class="wrapper">

<h1>Aggiungi commissione</h1>
<form id="copia_commissione" action="process.php" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="name">Cliente / Buyer</label>
      <input id="name" name="name" type="text" placeholder="First and last name" autofocus>
    </li>
    <li>
      <label for="indirizzo">Indirizzo / Address</label>
      <input id="indirizzo" name="indirizzo" type="text" placeholder="Via Roma 123">
    </li>
    <li>
      <label for="tel">Telefono</label>
      <input id="tel" name="tel" type="text" placeholder="Eg. +39 04220000000">
    </li>
    <li>
      <label for="fax">Fax</label>
      <input id="fax" name="fax" type="text" placeholder="Eg. +39 04220000000">
    </li>
    <li>
      <label for="piva">P.IVA</label>
      <input id="piva" name="piva" type="text" placeholder="Eg. 1234567890">
    </li>
  </ol>
</fieldset>
 
<fieldset class="normale">
  <legend>Ordine</legend>
  <ol>
    <li>
      <label for="spedizione_mezzo">Spedizione a Mezzo / Delivery Throught</label>
      <input id="spedizione_mezzo" name="spedizione_mezzo" type="text" placeholder="">
    </li>
    <li>
      <label for="pagamento">Pagamento / Payment</label>
      <input id="pagamento" name="pagamento" type="text" placeholder="Eg. Bonifico">
    </li>
    <li>
      <label for="banca">Banca / Bank</label>
      <input id="banca" name="banca" type="text" placeholder="Eg. Unicredit Banca - via Roma 123, Milano (MI)">
    </li>
    <li>
      <label for="abi">ABI</label>
      <input id="abi" name="abi" type="text" placeholder="Eg. 1234">
    </li>
    <li>
      <label for="cab">CAB</label>
      <input id="cab" name="cab" type="text" placeholder="Eg. 12345">
    </li>
    <li>
      <label for="porto">Porto / Carriage</label>
      <input id="porto" name="porto" type="text" placeholder="Eg. Genova">
    </li>
    <li>
      <label for="consegna_decorrenza">Consegna anticipata / Con decorrenza</label>
      <input id="consegna_decorrenza" name="consegna_decorrenza" type="text" placeholder="Eg. Maggio 2014">
    </li>
  </ol>
</fieldset>
 
<fieldset class="normale">
  <legend>Altro</legend>
  <ol>
    <li>
      <label for="agente">Agente / Agent</label>
      <input id="agente" name="agente" type="text" placeholder="">
    </li>
    <li>
      <label for="note">Notes</label>
      <textarea id="note" name="note" type="text" placeholder=""></textarea>
    </li>
    <li>
      <label for="data">Data</label>
      <input id="data" name="data" type="date" placeholder="">
    </li>
    <li>
      <label for="numero">N</label>
      <input id="numero" name="numero" type="text" placeholder="">
    </li>
  </ol>
</fieldset>

<fieldset class="commissioni">
  <legend>Commissione</legend>
  <ol class="clonedSection commissione" id="commissione_1">
    <li>
      <label for="modello">Modello / Model</label>
      <input id="modello" name="modello" type="text" placeholder="">
    </li>
    <li>
      <label for="tessuto">Tessuto / Fabric</label>
      <input id="tessuto" name="tessuto" type="text" placeholder="">
    </li>
    <li>
      <label for="colore">Colore / Colour</label>
      <input id="colore" name="colore" type="text" placeholder="">
    </li>
    <li>
      <label for="misura">Misura / Size</label>
      <select name="misura" >
        <option value="38" selected="selected">38</option>
        <option value="40">40</option>
        <option value="42">42</option>
        <option value="44">44</option>
        <option value="46">46</option>
        <option value="48">48</option>
        <option value="50">50</option>
        <option value="52">52</option>
        <option value="54">54</option>
      </select>
    </li>
    <li>
      <label for="totale">Totate / Total</label>
      <input id="totale" name="totale" type="text" placeholder="">
    </li>
    <li>
      <label for="prezzo">Prezzo / Price &euro;</label>
      <input id="prezzo" name="prezzo" type="text" placeholder="1000.00">
    </li>
  </ol>
  
</fieldset>
<div class="footer_nav">
  <button id="btnAdd">Aggiungi Elemento</button>
  <br><br>
  <button type="submit">Invia</button>
</div>

</form>	
</div> <!--fine wrapper-->
<div class="risultato"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

</body>

</html>

<?php
// fine verifica login
} else {
  // die();
  header('LOCATION:login.php'); 
  die();
}
?>