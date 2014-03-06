<?php
ob_start();
session_start();
require 'config.php';

// Dichiarazioni variabili relative al cliente
$nome = assignToVar('nome');;
$cognome = assignToVar('cognome');
$email = assignToVar('email');
$username = assignToVar('username');
$password = htmlspecialchars($_POST['password']);
$livello = assignToVar('livello');
$id = (int)htmlspecialchars($_GET['id']);


// Dichiarazione funzione che verifica che i campi generali relativi al cliente non siano vuoti e ritorna il relativo valore
function assignToVar ($name) {
	if ( !empty($_POST[$name]) ) {
		$name = htmlspecialchars($_POST[$name]);
	} else { $name = "N/D"; }
	return $name;
}
?>

<?php
// dichiarazione dell'array contenente i valori della parte relativa al cliente (dati replicati, da sistemare e gestire anche l'output con questo array)
$dati = array(
	'nome'				=>		$nome,
	'cognome'			=>		$cognome,
	'email'				=>		$email,
	'username'			=>		$username,
	'livello'			=>		$livello,
	'id'				=>		$id
);

if (!empty($password)) {
	$dati['password'] = crypt($password, "123stella");
	$sql = "UPDATE utenti SET nome = :nome, cognome = :cognome, email = :email, username = :username, password = :password, livello = :livello WHERE id = :id;";
} else  {
	$sql = "UPDATE utenti SET nome = :nome, cognome = :cognome, email = :email, username = :username, livello = :livello WHERE id = :id;";
}

// query che salva i valori precedentemente dichiarati nel database
$salva = executeQuery($sql, $dati, $conn);

if ($salva) {
	header("location: users.php");
}

?>