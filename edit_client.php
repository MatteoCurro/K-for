<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {
require('config.php');

require("header.php");

// varifico che sia stato un valore tramite get dell'id del cliente
if ( isset($_GET['id']) && !empty($_GET['id']) ) {
  $id = (int)htmlspecialchars($_GET['id']);
}
?>

<div class="wrapper">

<?php
// effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
  $clienti = query('SELECT * FROM clienti where id = :id LIMIT 1', array('id' => $id), $conn);
  if ($clienti) {
    // ciclo il cliente
    foreach ($clienti as $cliente) {

      ?>

<h1>Modifica utente</h1>
<form id="copia_commissione" action="process_edit_client.php?id=<?php echo $id; ?>" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="nome">Nome</label>
      <input id="nome" name="nome" type="text" placeholder="Es. Mario" autofocus required x-moz-errormessage="Inserisci il nome" value="<?php echo $cliente['nome']; ?>">
    </li>
    <li>
      <label for="cognome">Cognome</label>
      <input id="cognome" name="cognome" type="text" placeholder="Es. Rossi" required x-moz-errormessage="Inserisci il cognome" value="<?php echo $cliente['cognome']; ?>">
    </li>
    <li>
      <label for="data_nascita">Data di nascita</label>
      <input id="data_nascita" name="data_nascita" type="date" placeholder="10/07/1973" value="<?php 
          $data = strtotime($cliente['data_nascita']);
          echo date('Y-m-d',$data); 
        ?>">
    </li>
    <li>
      <label for="componenti_nucleo">Componenti nucleo familiare</label>
      <input id="componenti_nucleo" name="componenti_nucleo" type="number" placeholder="Es. 7" x-moz-errormessage="Inserisci il numero di componenti del nucleo" min="1" max="10" value="<?php echo $cliente['componenti_nucleo']; ?>">
    </li>
    <li>
      <label for="persona_interessata">Persona Interessata</label>
      <input id="persona_interessata" name="persona_interessata" type="text" placeholder="Es. Il figlio" x-moz-errormessage="Inserisci la persona interessata" value="<?php echo $cliente['persona_interessata']; ?>">
    </li>
    <li>
      <label for="professione">Professione</label>
      <input id="professione" name="professione" type="text" placeholder="Es. Impiegato" x-moz-errormessage="Inserisci la professione" value="<?php echo $cliente['professione']; ?>">
    </li>

    <br><br>

    <li>
      <label for="citta">Citt&agrave;</label>
      <input id="citta" name="citta" type="text" placeholder="Es. Milano" x-moz-errormessage="Inserisci la città" value="<?php echo $cliente['citta']; ?>">
    </li>
    <li>
      <label for="indirizzo">Indirizzo</label>
      <input id="indirizzo" name="indirizzo" type="text" placeholder="Es. Via Roma, 1" x-moz-errormessage="Inserisci l'indirizzo'" value="<?php echo $cliente['indirizzo']; ?>">
    </li>
    <li>
      <label for="tel_fisso">Telefono fisso</label>
      <input id="tel_fisso" name="tel_fisso" type="tel" placeholder="Es. 0422124353" x-moz-errormessage="Inserisci il numero di telefono fisso" value="<?php echo $cliente['tel_fisso']; ?>">
    </li>
    <li>
      <label for="tel_cell">Telefono cellulare</label>
      <input id="tel_cell" name="tel_cell" type="tel" placeholder="Es. 3471223345" x-moz-errormessage="Inserisci il numero di telefono fisso" value="<?php echo $cliente['tel_cell']; ?>">
    </li>
    <li>
      <label for="data_incontro">Data Incontro</label>
      <input id="data_incontro" name="data_incontro" type="date" placeholder="" value="<?php 
          $data = strtotime($cliente['data_incontro']);
          echo date('Y-m-d',$data); 
        ?>">
    </li>
    <li>
      <label for="codice_contratto">Codice contratto / Iscrizione</label>
      <input id="codice_contratto" name="codice_contratto" type="text" placeholder="Es. H 0002020" x-moz-errormessage="Inserisci codice contratto" value="<?php echo $cliente['codice_contratto']; ?>">
    </li>
    <li>
      <label for="importo_contratto">Importo contratto</label>
      <input id="importo_contratto" name="importo_contratto" type="number" step="any" min="0" placeholder="Es. 600.00" x-moz-errormessage="Inserisci l'importo del contratto" value="<?php echo $cliente['importo_contratto']; ?>">
    </li>
    <li>
      <label for="modalita_pagamento">Modalit&agrave; Pagamento</label>
      <select name="modalita_pagamento" x-moz-errormessage="Inserisci la modalità di pagamento">
        <option value="1" <?php if ($cliente['modalita_pagamento'] == "1"): ?> selected="selected"<?php endif; ?>>Contrassegno / Assegno</option>
        <option value="2" <?php if ($cliente['modalita_pagamento'] == "2"): ?> selected="selected"<?php endif; ?>>Bonifico anticipato / Contanti</option>
        <option value="3" <?php if ($cliente['modalita_pagamento'] == "3"): ?> selected="selected"<?php endif; ?>>Online</option>
      </select>
    </li>
    <li>
      <label for="note">Note</label>
      <textarea id="note" name="note" placeholder="Es. Acconto &euro;100."><?php echo $cliente['note']; ?></textarea>
    </li>
    <li>
      <label for="codice">Codice corso</label>
      <input id="codice" name="codice" type="text" placeholder="Es. 000311" x-moz-errormessage="Inserisci il codice" value="<?php echo $cliente['codice']; ?>">
    </li>
    <?php if (isset($_SESSION["livello"]) && ($_SESSION["livello"] != 2)) { ?>
      <li>
        <label for="rinnovo">Rinnovo?</label>
        <input id="rinnovo" name="rinnovo" type="checkbox" value="1" placeholder="E' un rinnovo?" <?php if ($cliente['rinnovo']) { echo 'checked';}; ?>>
      </li>
    <?php } ?>
    <li>
      <label for="recall">Recall?</label>
      <input id="recall" name="recall" type="checkbox" value="1" placeholder="Va richiamato?" <?php if ($cliente['recall']) { echo 'checked';}; ?>>
    </li>
    <li>
      <label for="data_recall">Data Recall / Rinnovo</label>
      <input id="data_recall" name="data_recall" type="date" placeholder="" value="<?php 
          $data = strtotime($cliente['data_recall']);
          echo date('Y-m-d',$data); 
        ?>">
    </li>
  </ol>
</fieldset>

<div class="footer_nav">
  <button type="submit">Invia</button>
</div>

</form>
<?php 
    } 
  }
?>
</div> <!--fine wrapper-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
(function($){
  // disabilito il campo recall se non è spuntata la checkbox
  var recall = $('#recall, #rinnovo').is(':checked');
  $('#recall, #rinnovo').click(function() {
    recall = $('#recall, #rinnovo').is(':checked');
    $('#data_recall').prop('disabled', !(recall));
  });
  $('#data_recall').prop('disabled', !(recall));
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