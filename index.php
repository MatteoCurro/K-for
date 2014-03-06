<?php 
ob_start();
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require 'config.php';

require("header.php");

?>
	<div class="wrapper">
	<h2>Clienti</h2>
	<a class="button float_r" href="add_client.php?">Aggiungi nuovo</a>
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
// effettuo una query per recuperare i dati relativi ai clienti
	$utenti = query('SELECT * FROM clienti', array(), $conn);
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
			<td><?php echo $utente['data_incontro']; ?></td>
			<td><a class="button" href="view_client.php?id=<?php echo $utente['id']; ?>">View</a></td>
			<td><a class="button" href="edit_client.php?id=<?php echo $utente['id']; ?>">Edit</a></td>
			<td><a class="button red delete" href="delete_client.php?id=<?php echo $utente['id']; ?>">Delete</a></td>
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
</body>

</html>
<?php
// fine verifica login
} else {
	header('LOCATION:login.php'); 
    die();
}
?>