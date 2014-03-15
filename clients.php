<?php 
ob_start();
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("config.php");

require("header.php");

?>
	<div class="wrapper">
	<a class="button float_r" href="add_client.php">Aggiungi nuovo</a>
	<h2>Clienti</h2>
	<p>Elenco completo dei clienti.</p>
	<?php
		// include il form per la ricerca avanzata
		require('search_form.php');
	?>
	<table class="clients">
		<tr>
		<th>ID</th>
		<th>Nome</th>
		<th>Cognome</th>
		<th>Citt&agrave;</th>
		<th>Data</th>
		<th></th>
		<th></th>
		<th></th>
		</tr>

<?php
	// include il file che effettua la ricerca di default o avanzata
	require('process_search.php');
	// filtro i clienti
	if ($clienti) {
		// ciclo il cliente
		foreach ($clienti as $cliente) {
			// print_r($cliente);
			?>
		<tr>
			<td><?php echo $cliente['id']; ?></td>
			<td><?php echo $cliente['nome']; ?></td>
			<td><?php echo $cliente['cognome']; ?></td>
			<td><?php echo $cliente['citta']; ?></td>
			<td><?php 
					$data = strtotime($cliente['data_incontro']);
					echo date('d/m/y',$data); 
				?></td>
			<td><a class="button" href="view_client.php?id=<?php echo $cliente['id']; ?>">View</a></td>
			<td><a class="button" href="edit_client.php?id=<?php echo $cliente['id']; ?>">Edit</a></td>
			<td><a class="button red delete" href="delete_client.php?id=<?php echo $cliente['id']; ?>">Delete</a></td>
		</tr>
		<?php }
	} ?>
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
	header('LOCATION:clients_restricted.php'); 
    die();
}
?>