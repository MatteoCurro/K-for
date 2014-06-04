<?php 
ob_start();
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true  && ($_SESSION["livello"] <= 1 || $_SESSION["livello"] == 3)) {

require('config.php');


if (isset( $_GET['data_fine'] ) && 
    !empty( $_GET['data_fine'] )) {

	$dati =  array(
	    'data_inizio' => htmlspecialchars($_GET['data_inizio']),
	    'data_fine' => htmlspecialchars($_GET['data_fine'])
	);

} else {
	$dati =  array(
	    'data_inizio' => date('Y-m-d', strtotime("-365 days")),
	    'data_fine' => date('Y-m-d', strtotime("+31 days"))
	);
}
$conditions = array();
if (!empty($_GET['priorita'])) {
	  $conditions[] = ' AND priorita = "'.$_GET['priorita'].'"';
	}

require("header.php");

?>
	<div class="wrapper">
	<h2>Clienti da richiamare</h2>
	<form action="" type="GET" class="search_reminder clearfix">
			<?php // set the default timezone to use. Available since PHP 5.1
			date_default_timezone_set('UTC'); ?>
			<label for="data_inizio">Data inizio</label>
			<input id="data_inizio" name="data_inizio" type="date" value="<?php echo date('Y-m-d', strtotime($dati['data_inizio'])); ?>">
			<label for="data_fine">Data fine</label>
			<input id="data_fine" name="data_fine" type="date" value="<?php echo date('Y-m-d', strtotime($dati['data_fine'])); ?>">
		<br>
		<label for="priorita">Priorit&agrave;</label>
		<select name="priorita" id="">
			<option value="">-Seleziona Priorit&agrave;-</option>
			<option value="1">Bassa</option>
			<option value="2">Normale</option>
			<option value="3">Alta</option>
		</select>

			<button type="submit">Cerca</button>
	 </form>
	<table class="clients">
		<tr>
		<th>ID</th>
		<th>Nome</th>
		<th>Cognome</th>
		<th>Citt&agrave;</th>
		<th>Data incontro</th>
		<th>Data recall</th>
		<th></th>
		<th></th>
		<?php if (isset($_SESSION["livello"]) && ($_SESSION["livello"] == 0 )) { ?>
		<th></th>
		<?php } ?>
		</tr>

<?php
// effettuo una query per recuperare i dati relativi ai clienti
	

	$utenti = query("SELECT * FROM clienti WHERE rinnovo = 1 AND data_recall BETWEEN STR_TO_DATE(:data_inizio, '%Y-%m-%d') AND STR_TO_DATE(:data_fine, '%Y-%m-%d') ".implode(" AND ", $conditions)." ORDER BY data_recall ASC;", $dati, $conn);
	if ($utenti) {
		// ciclo il cliente
		foreach ($utenti as $utente) {
			// print_r($utente);
			?>
		<tr>
			<td><?php echo $utente['id']; ?></td>
			<td><?php echo $utente['nome']; ?></td>
			<td><?php echo $utente['cognome']; ?></td>
			<td><?php echo $utente['citta']; ?></td>
			<td><?php 
					$data = strtotime($utente['data_incontro']);
					echo date('d/m/y',$data); 
				?></td>
				<td><strong><?php 
					$data = strtotime($utente['data_recall']);
					echo date('d/m/y',$data); 
				?></strong></td>
			<td><a class="button" href="view_client.php?id=<?php echo $utente['id']; ?>">View</a></td>
			<td><a class="button" href="edit_client.php?id=<?php echo $utente['id']; ?>">Edit</a></td>
			<?php if (isset($_SESSION["livello"]) && ($_SESSION["livello"] == 0 )) { ?>
			<td><a class="button red delete" href="delete_client.php?id=<?php echo $utente['id']; ?>">Delete</a></td>
			<?php } ?>
		</tr>
		<?php }
	} else { echo "<tr><td colspan='9'>Nessun cliente da richiamare!</td></tr>";}?>
	</table>
	</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
// azioni all'invio del form
$('.delete').on('click', function (e) {
  e.preventDefault();
  var $this = $(this);
  // conferma
    if (confirm("Sei sicuro di voler eliminare l'elemento selezionato?")) {
	  // effettuo la chiamata ajax
	  $.ajax({
	      type: 'GET',
	      url: $this.attr('href'),
	      cache: false,
	      // traditional: true,
	      data: {
	        // commissioni: array_commissioni
	      },
	      success: function(data) {
	        $this.parent().parent('tr').fadeOut(400);
	         return false;
	      }
	  });
     }     
});

(function($){
	  //  Imposto la data corrente nel campo data incontro di default
  Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
  });

  // $('#data_inizio').val(new Date().toDateInputValue());
})(jQuery);
</script>

<?php
require('footer.php');
// fine verifica login
} else {
	header('LOCATION:login.php'); 
    die();
}
?>