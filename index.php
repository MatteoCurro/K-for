<?php 
ob_start();
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require 'config.php';

require("header.php");

?>
	<div class="wrapper">
	<?php
  // effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
    $utenti = query('SELECT * FROM utenti where id = :id LIMIT 1', array('id' => $_SESSION["user_id"]), $conn);
    if ($utenti) {
      // ciclo il cliente
      foreach ($utenti as $utente) { ?>

	<h2>Benvenuto <?php echo $utente['nome']; ?>!</h2>
	<p>Utilizza il men&ugrave; per navigare tra le pagine.</p>
	<?php  } // Fine foreach
    } // Fine if utenti ?>

<?php
require('footer.php');
// fine verifica login
} else {
	header('LOCATION:login.php'); 
    die();
}
?>