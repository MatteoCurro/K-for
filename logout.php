<?php
	session_start(); 

	// Desetta tutte le variabili di sessione.
	session_unset();
	// Infine , distrugge la sessione.
	session_destroy();
	header('LOCATION:login.php'); 
	die();
?>