<?php 
ob_start();
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true  && $_SESSION["livello"] == 1) {

require('config.php');


if (isset( $_GET['recall_days'] ) && 
    !empty( $_GET['recall_days'] )) {

	$dati =  array(
	    'recall_days' => (int)htmlspecialchars($_GET['recall_days'])
	);

} else {
	$dati =  array(
	    'recall_days' => 7
	);
}

require("header.php");

?>
	<div class="wrapper">
	<h2>Clienti da richiamare</h2>
	<form action="" type="GET">
		<p class="float_r">Mostra i recall dei prossimi 
			<select name="recall_days" id="recall_days" onchange="this.form.submit()">
				<option value="7" <?php if ($dati['recall_days'] == "7"): ?> selected="selected"<?php endif; ?>>7 giorni</option>
				<option value="15" <?php if ($dati['recall_days'] == "15"): ?> selected="selected"<?php endif; ?>>15 giorni</option>
				<option value="30" <?php if ($dati['recall_days'] == "30"): ?> selected="selected"<?php endif; ?>>30 giorni</option>
				<option value="60" <?php if ($dati['recall_days'] == "60"): ?> selected="selected"<?php endif; ?>>60 giorni</option>
				<option value="90" <?php if ($dati['recall_days'] == "90"): ?> selected="selected"<?php endif; ?>>90 giorni</option>
				<option value="120" <?php if ($dati['recall_days'] == "120"): ?> selected="selected"<?php endif; ?>>120 giorni</option>
				<option value="150" <?php if ($dati['recall_days'] == "150"): ?> selected="selected"<?php endif; ?>>150 giorni</option>
				<option value="180" <?php if ($dati['recall_days'] == "180"): ?> selected="selected"<?php endif; ?>>180 giorni</option>
			</select>
		 </p>
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
		<th></th>
		</tr>

<?php
// effettuo una query per recuperare i dati relativi ai clienti
	

	$utenti = query('SELECT * FROM clienti WHERE recall = 1 AND data_recall <= DATE_ADD(CURDATE(),INTERVAL :recall_days DAY) ORDER BY data_recall ASC;', $dati, $conn);
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
			<td><a class="button red delete" href="delete_client.php?id=<?php echo $utente['id']; ?>">Delete</a></td>
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
</script>

<?php
require('footer.php');
// fine verifica login
} else {
	header('LOCATION:login.php'); 
    die();
}
?>