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
      // visualizza il cliente solamente se l'utente corrente è admin o è l'autore del cliente selezionato
      if ($_SESSION["livello"] <= 1 || $_SESSION["user_id"] == $cliente["id_utente"]) {
      ?>
      <a class="button float_r" href="edit_client.php?id=<?php echo $cliente['id']; ?>">Modifica</a>

      <h1>Visualizza cliente: <?php echo $cliente['nome']; ?> <?php echo $cliente['cognome']; ?></h1>

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
        <li><strong>Email:</strong> <a href="mailto:<?php echo $cliente['email']; ?>"><?php echo $cliente['email']; ?></a></li>
        <li><strong>Citt&agrave;:</strong> <?php echo $cliente['citta']; ?></li>
        <li><strong>Indirizzo:</strong> <?php echo $cliente['indirizzo']; ?></li>
        <li><strong>Data incontro:</strong> <?php 
                echo date('d/m/Y',strtotime($cliente['data_incontro'])); 
              ?></li>
        <li><strong>Codice contratto:</strong> <?php echo $cliente['codice_contratto']; ?></li>
        <li><strong>Importo contratto:</strong> &euro; <?php echo number_format((float)$cliente['importo_contratto'], 2, '.', ''); ?></li>
        <li><strong>Modalit&agrave; pagamento:</strong> <?php 
        switch ($cliente['modalita_pagamento']) {
          case '1':
            echo 'Contrassegno';
            break;

          case '2':
            echo 'Bonifico anticipato';
            break;

          case '3':
            echo 'Online';
            break;
          
          default:
            echo 'N/D';
            break;
        }
        ?></li>
        <li><strong>Note:</strong> <?php echo $cliente['note']; ?></li>
        <li><strong>Codice utente/corso:</strong> <?php echo $cliente['codice']; ?></li>
        <li><strong>Rinnovo:</strong> <?php echo $cliente['rinnovo'] ? 'Si' : 'No'; ?></li>
        <li><strong>Recall:</strong> <?php echo $cliente['recall'] ? 'Da richiamare' : 'No'; ?></li>
        <?php if ($cliente['recall'] || $cliente['rinnovo']) { ?>
            <li><strong>Priorit&agrave;:</strong> <?php 
            switch ($cliente['priorita']) {
              case '1':
                echo 'Bassa';
                break;

              case '2':
                echo 'Normale';
                break;

              case '3':
                echo 'Alta';
                break;

               default:
                 echo 'N/D';
                 break;
             } ?></li>
        <?php } ?>
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
          <li><strong>Aggiunto da:</strong> <?php echo $utente['nome'].' '.$utente['cognome']; ?></li>
          <?php 
            } // fine foreach per estrarre il nome dell'utente
          } // fine if per estrarre il nome dell'utente
        ?>

        <li><form class="pagamento" name="_xclick" action="https://www.paypal.com/it/cgi-bin/webscr" method="post">
            <strong>Pagamento:</strong>

            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="amministrazione@k-for.it">
            <input type="hidden" name="currency_code" value="EUR">
            <input type="hidden" name="item_name" value="Materiale corso di inglese">
            &euro;<input type="text" name="amount" placeholder="Es. 100.00">

            <INPUT TYPE="hidden" NAME="first_name" VALUE="<?php echo $cliente['nome']; ?>">
            <INPUT TYPE="hidden" NAME="last_name" VALUE="<?php echo $cliente['cognome']; ?>">
            <INPUT TYPE="hidden" NAME="city" VALUE="<?php echo $cliente['citta']; ?>">
            <INPUT TYPE="hidden" NAME="state" VALUE="IT">
            <INPUT TYPE="hidden" NAME="lc" VALUE="IT">
            <button type="submit">Paga adesso</button>
          </li>
        </form>


      </ol>
      <?php 
      } else {// fine if per controllare se l'utente può visualizzare il cliente corrente
        // stampa a video un messaggio di errore
        echo "<h2>OPS!</h2>
        <p>Non hai i permessi necessari a visualizzare l'utente specificato!</p>";
      }
    } // fine foreach clienti
  } // fine if clienti
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