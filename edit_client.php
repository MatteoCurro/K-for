<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("header.php");
require('config.php');
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
      <input id="componenti_nucleo" name="componenti_nucleo" type="number" placeholder="Es. 7" required x-moz-errormessage="Inserisci il numero di componenti del nucleo" min="1" max="10" value="<?php echo $cliente['componenti_nucleo']; ?>">
    </li>
    <li>
      <label for="persona_interessata">Persona Interessata</label>
      <input id="persona_interessata" name="persona_interessata" type="text" placeholder="Es. Il figlio" required x-moz-errormessage="Inserisci la persona interessata" value="<?php echo $cliente['persona_interessata']; ?>">
    </li>
    <li>
      <label for="professione">Professione</label>
      <input id="professione" name="professione" type="text" placeholder="Es. Impiegato" required x-moz-errormessage="Inserisci la professione" value="<?php echo $cliente['professione']; ?>">
    </li>

    <br><br>

    <li>
      <label for="citta">Citt&agrave;</label>
      <input id="citta" name="citta" type="text" placeholder="Es. Milano" required x-moz-errormessage="Inserisci la città" value="<?php echo $cliente['citta']; ?>">
    </li>
    <li>
      <label for="indirizzo">Indirizzo</label>
      <input id="indirizzo" name="indirizzo" type="text" placeholder="Es. Via Roma, 1" required x-moz-errormessage="Inserisci l'indirizzo'" value="<?php echo $cliente['indirizzo']; ?>">
    </li>
    <li>
      <label for="tel_fisso">Telefono fisso</label>
      <input id="tel_fisso" name="tel_fisso" type="tel" placeholder="Es. 3471223345" required x-moz-errormessage="Inserisci il numero di telefono fisso" value="<?php echo $cliente['tel_fisso']; ?>">
    </li>
    <li>
      <label for="tel_cell">Telefono cellulare</label>
      <input id="tel_cell" name="tel_cell" type="tel" placeholder="Es. 0422124353" required x-moz-errormessage="Inserisci il numero di telefono fisso" value="<?php echo $cliente['tel_cell']; ?>">
    </li>
    <li>
      <label for="data_incontro">Data Incontro</label>
      <input id="data_incontro" name="data_incontro" type="date" placeholder="" value="<?php 
          $data = strtotime($cliente['data_incontro']);
          echo date('Y-m-d',$data); 
        ?>">
    </li>
    <li>
      <label for="note">Note</label>
      <textarea id="note" name="note" placeholder="Es. Acconto &euro;100."><?php echo $cliente['note']; ?></textarea>
    </li>
    <li>
      <label for="codice">Codice</label>
      <input id="codice" name="codice" type="text" placeholder="Es. AB123" x-moz-errormessage="Inserisci il codice" value="<?php echo $cliente['codice']; ?>">
    </li>
    <li>
      <label for="rinnovo">Rinnovo?</label>
      <input id="rinnovo" name="rinnovo" type="checkbox" value="1" placeholder="E' un rinnovo?" <?php if ($cliente['rinnovo']) { echo 'checked';}; ?>>
    </li>
    <li>
      <label for="recall">Recall?</label>
      <input id="recall" name="recall" type="checkbox" value="1" placeholder="Va richiamato?" <?php if ($cliente['recall']) { echo 'checked';}; ?>>
    </li>
    <li>
      <label for="data_recall">Data Recall</label>
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