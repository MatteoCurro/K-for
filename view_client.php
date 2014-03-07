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
<a class="button float_r" href="edit_client.php?id=<?php echo $cliente['id']; ?>">Modifica</a>
<h1>Visualizza cliente</h1>

<ol class="single_view_client">
  <li><strong>Nome:</strong> <?php echo $cliente['nome']; ?></li>
  <li><strong>Cognome:</strong> <?php echo $cliente['cognome']; ?></li>
  <li><strong>Data di nascita:</strong> <?php 
          echo date('d/m/Y',strtotime($cliente['data_nascita'])); 
        ?></li>
  <li><strong>Componenti nucleo:</strong> <?php echo $cliente['componenti_nucleo']; ?></li>
  <li><strong>Persona interessata:</strong> <?php echo $cliente['persona_interessata']; ?></li>
  <li><strong>Professione:</strong> <?php echo $cliente['professione']; ?></li>
  <li><strong>Tel. cellulare:</strong> <?php echo $cliente['tel_cell']; ?></li>
  <li><strong>Tel. fisso:</strong> <?php echo $cliente['tel_fisso']; ?></li>
  <li><strong>Citt&agrave;:</strong> <?php echo $cliente['citta']; ?></li>
  <li><strong>Indirizzo:</strong> <?php echo $cliente['indirizzo']; ?></li>
  <li><strong>Data incontro:</strong> <?php 
          echo date('d/m/Y',strtotime($cliente['data_incontro'])); 
        ?></li>
  <li><strong>Recall:</strong> <?php echo $cliente['recall'] ? 'Da richiamare' : 'No'; ?></li>
  <li><strong>Data recall:</strong> <?php 
          echo $cliente['recall'] ? date('d/m/Y',strtotime($cliente['data_recall'])) : 'N/D'; 
        ?></li>
  <?php
  // effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
    $utenti = query('SELECT * FROM utenti where id = :id LIMIT 1', array('id' => $cliente['id_utente']), $conn);
    if ($utenti) {
      // ciclo il cliente
      foreach ($utenti as $utente) {

        ?>
    <li><strong>Cliente aggiunto da:</strong> <?php echo $utente['nome'].' '.$utente['cognome']; ?></li>
    <?php 
      } 
    }
  ?>
</ol>
<?php 
    } 
  }
?>
</div> <!--fine wrapper-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
(function($){
  // disabilito il campo recall se non è spuntata la checkbox
  var recall = $('#recall').is(':checked');
  $('#recall').click(function() {
    recall = $('#recall').is(':checked');
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