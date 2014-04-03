<?php
	// dichiarazione array delle condizioni per la ricerca
	$conditions = array();

	// solita funzione che assegna i dati passati alle variabili
	function assignToVar ($name) {
		if ( !empty($_GET[$name]) ) {
			$name = htmlspecialchars($_GET[$name]);
		} else { $name = ""; }
		return $name;
	}

	// Dichiarazioni variabili relative ai clienti
	$nome = assignToVar('nome');;
	$cognome = assignToVar('cognome');
	$codice = assignToVar('codice');
	$citta = assignToVar('citta');
	$id_utente = assignToVar('user_id');
	$recall = isset($_GET["recall"]) ? $_GET["recall"] : 0;

	// popolazione dell'array $conditions se i valori non sono vuoti
	if (!empty($nome)) {
	  $conditions[] = 'nome LIKE "%'.$nome.'%"';
	}
	if (!empty($cognome)) {
	  $conditions[] = 'cognome LIKE "'.$cognome.'%"';
	}
	if (!empty($codice)) {
	  $conditions[] = 'codice LIKE "'.$codice.'%"';
	}
	if (!empty($citta)) {
	  $conditions[] = 'citta LIKE "%'.$citta.'%"';
	}
	// se l'utente è admin permetto la ricerca altrimenti la limito
	// ai soli clienti aggiunti dall'utente corrente
	if (isset($_SESSION["livello"]) && $_SESSION["livello"] == 1) {
		if (!empty($id_utente)) {
		  $conditions[] = 'id_utente = "'.$id_utente.'"';
		}
	} else {
		  $conditions[] = 'id_utente = "'.$_SESSION["user_id"].'"';
	}
	// se l'utente è admin permetto la ricerca altrimenti la limito
	// ai soli clienti che non sono recall
	// NB: di default la ricerca viene effettuata per i clienti acquisiti
	// mentre vengono ignorati i recall
	if (isset($_SESSION["livello"]) && $_SESSION["livello"] == 1) {
		if (isset($recall)) {
		  $conditions[] = 'recall = '.$recall.'';
		}
	} else {
		$conditions[] = 'recall = 0';
	}

	require('pagination.php');



	// se l'array $conditions non è vuoto imposto la query di ricerca altrimenti una standard
	if(count($conditions)) {
	    $query = "SELECT * FROM clienti WHERE ".implode(" AND ", $conditions)." ORDER BY id DESC $max";
	} else {
		$query = "SELECT * FROM clienti ORDER BY id DESC $max";
	}

	

	// echo $query;
	// effettuo una query per recuperare i dati relativi ai clienti
	$clienti = query($query, $conditions, $conn);

?>