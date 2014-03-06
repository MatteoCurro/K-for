<?php
ob_start();
session_start();
require 'config.php';

// Dichiarazioni variabili relative al cliente
$nome = assignToVar('nome');; 
$cognome = assignToVar('cognome'); 
$email = assignToVar('email'); 
$username = assignToVar('username'); 
$password = assignToVar('password'); 
$livello = assignToVar('livello'); 


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
	'password'			=>		crypt($password, "123stella"),
	'livello'			=>		$livello
);

// query che salva i valori precedentemente dichiarati nel database
$salva = executeQuery("INSERT INTO utenti
			(nome, cognome, email, username, password, livello) 
	VALUES 	(:nome, :cognome, :email, :username, :password, :livello);", 
	$dati, $conn);

if ($salva) {
	header("location: users.php");
}

?>