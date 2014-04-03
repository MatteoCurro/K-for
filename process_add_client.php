<?php
ob_start();
session_start();
require 'config.php';

// Dichiarazioni variabili relative al cliente
$nome = assignToVar('nome');;
$cognome = assignToVar('cognome');
$data_nascita = assignToVar('data_nascita');
$componenti_nucleo = assignToVar('componenti_nucleo');
$persona_interessata = assignToVar('persona_interessata');
$professione = assignToVar('professione');
$tel_cell = assignToVar('tel_cell');
$tel_fisso = assignToVar('tel_fisso');
$citta = assignToVar('citta');
$indirizzo = assignToVar('indirizzo');
$data_incontro = assignToVar('data_incontro');
$note = assignToVar('note');
$codice_contratto = assignToVar('codice_contratto');
$importo_contratto = assignToVar('importo_contratto');
$modalita_pagamento = assignToVar('modalita_pagamento');
$codice = assignToVar('codice');
$rinnovo = isset($_POST["rinnovo"]) ? $_POST["rinnovo"] : 0;
$data_recall = assignToVar('data_recall');
$recall = isset($_POST["recall"]) ? $_POST["recall"] : 0;
$id_utente = $_SESSION['user_id'];


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
	'nome'					=>		$nome,
	'cognome'				=>		$cognome,
	'data_nascita'			=>		$data_nascita,
	'componenti_nucleo'		=>		$componenti_nucleo,
	'persona_interessata'	=>		$persona_interessata,
	'professione'			=>		$professione,
	'tel_cell'				=>		$tel_cell,
	'tel_fisso'				=>		$tel_fisso,
	'citta'					=>		$citta,
	'indirizzo'				=>		$indirizzo,
	'data_incontro'			=>		$data_incontro,
	'note'					=>		$note,
	'codice_contratto'		=>		$codice_contratto,
	'importo_contratto'		=>		$importo_contratto,
	'modalita_pagamento'	=>		$modalita_pagamento,
	'codice'				=>		$codice,
	'rinnovo'				=>		$rinnovo,
	'data_recall'			=>		$data_recall,
	'recall'				=>		$recall,
	'id_utente'				=>		$id_utente
);

// query che salva i valori precedentemente dichiarati nel database
$salva = executeQuery("INSERT INTO clienti
			(nome, cognome, data_nascita, componenti_nucleo, persona_interessata, professione, tel_cell, tel_fisso, citta, indirizzo, data_incontro, codice_contratto, importo_contratto, modalita_pagamento, note, codice, rinnovo, data_recall, recall, id_utente)
	VALUES 	(:nome, :cognome, :data_nascita, :componenti_nucleo, :persona_interessata, :professione, :tel_cell, :tel_fisso, :citta, :indirizzo, :data_incontro, :codice_contratto, :importo_contratto, :modalita_pagamento, :note, :codice, :rinnovo, :data_recall, :recall, :id_utente);",
	$dati, $conn);
$id = $conn->lastInsertId();

if ($salva) {
	header("location: view_client.php?id=".$id);
}

?>