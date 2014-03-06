<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("header.php");

?>

<div class="wrapper">

<h1>Aggiungi utente</h1>
<form id="copia_commissione" action="process_add_client.php" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="nome">Nome</label>
      <input id="nome" name="nome" type="text" placeholder="Es. Mario" autofocus required x-moz-errormessage="Inserisci il nome">
    </li>
    <li>
      <label for="cognome">Cognome</label>
      <input id="cognome" name="cognome" type="text" placeholder="Es. Rossi" required x-moz-errormessage="Inserisci il cognome">
    </li>
    <li>
      <label for="data_nascita">Data di nascita</label>
      <input id="data_nascita" name="data_nascita" type="date" placeholder="1973-10-05">
    </li>
    <li>
      <label for="componenti_nucleo">Componenti nucleo familiare</label>
      <input id="componenti_nucleo" name="componenti_nucleo" type="number" placeholder="Es. 7" required x-moz-errormessage="Inserisci il numero di componenti del nucleo" min="1" max="10">
    </li>
    <li>
      <label for="persona_interessata">Persona Interessata</label>
      <input id="persona_interessata" name="persona_interessata" type="text" placeholder="Es. Il figlio" required x-moz-errormessage="Inserisci la persona interessata">
    </li>
    <li>
      <label for="professione">Professione</label>
      <input id="professione" name="professione" type="text" placeholder="Es. Impiegato" required x-moz-errormessage="Inserisci la professione">
    </li>

    <br><br>

    <li>
      <label for="citta">Citt&agrave;</label>
      <input id="citta" name="citta" type="text" placeholder="Es. Milano" required x-moz-errormessage="Inserisci la città">
    </li>
    <li>
      <label for="indirizzo">Indirizzo</label>
      <input id="indirizzo" name="indirizzo" type="text" placeholder="Es. Via Roma, 1" required x-moz-errormessage="Inserisci l'indirizzo'">
    </li>
    <li>
      <label for="tel_fisso">Telefono fisso</label>
      <input id="tel_fisso" name="tel_fisso" type="tel" placeholder="Es. 3471223345" required x-moz-errormessage="Inserisci il numero di telefono fisso">
    </li>
    <li>
      <label for="tel_cell">Telefono cellulare</label>
      <input id="tel_cell" name="tel_cell" type="tel" placeholder="Es. 0422124353" required x-moz-errormessage="Inserisci il numero di telefono fisso">
    </li>
    <li>
      <label for="data_incontro">Data Incontro</label>
      <input id="data_incontro" name="data_incontro" type="date" placeholder="">
    </li>
    <li>
      <label for="recall">Recall?</label>
      <input id="recall" name="recall" type="checkbox" value="1" placeholder="Va richiamato?">
    </li>
    <li>
      <label for="data_recall">Data Recall</label>
      <input id="data_recall" name="data_recall" type="date" placeholder="" disabled>
    </li>
  </ol>
</fieldset>

<div class="footer_nav">
  <button type="submit">Invia</button>
</div>

</form>	
</div> <!--fine wrapper-->
<div class="risultato"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
(function($){
  // disabilito il campo recall se non è spuntata la checkbox
  $('#recall').click(function() {
    var recall = $('#recall').is(':checked');
    $('#data_recall').prop('disabled', !(recall));
  });

  //  Imposto la data corrente nel campo data incontro di default
  Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
  });

  $('#data_incontro').val(new Date().toDateInputValue());
})(jQuery);

</script>

<?php
require('footer.php');
// fine verifica login
} else {
  // die();
  header('LOCATION:login.php'); 
  die();
}
?>