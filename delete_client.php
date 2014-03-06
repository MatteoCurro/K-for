<?php 

require 'config.php'; 

?>
<?php
$dati = array(
			'id'		=>		$_GET['id']
		);
		// eseguiamo la query per salvare i dati
		$delete = executeQuery("DELETE FROM clienti WHERE id = :id;", $dati, $conn);
?>