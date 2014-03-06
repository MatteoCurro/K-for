<?php

require 'config.php';

// Dichiarazioni variabili relative al cliente
$nome = assignToVar(1,0,'nome');; 
$indirizzo = assignToVar(1,1,'indirizzo'); 
$tel = assignToVar(1,2,'tel'); 
$fax = assignToVar(1,3,'fax'); 
$piva = assignToVar(1,4,'piva'); 
$spedizione_mezzo = assignToVar(2,0,'spedizione_mezzo');; 
$pagamento = assignToVar(2,1,'pagamento'); 
$banca = assignToVar(2,2,'banca'); 
$abi = assignToVar(2,3,'abi'); 
$cab = assignToVar(2,4,'cab'); 
$porto = assignToVar(2,5,'porto');
$consegna_decorrenza = assignToVar(2,6,'consegna_decorrenza'); 
$agente = assignToVar(3,0,'agente');; 
$note = assignToVar(3,1,'note'); 
$data = assignToVar(3,2,'data'); 
$n = assignToVar(3,3,'n');;

// Dichiarazione funzione che verifica che i campi generali relativi al cliente non siano vuoti e ritorna il relativo valore
function assignToVar ($first_i, $second_i, $name) {
	if ( !empty($_POST['commissioni'][$first_i][$second_i]['value']) ) {
		$name = htmlspecialchars($_POST['commissioni'][$first_i][$second_i]['value']);
	} else { $name = "N/D"; }
	return $name;
}
?>

<?php
// dichiarazione dell'array contenente i valori della parte relativa al cliente (dati replicati, da sistemare e gestire anche l'output con questo array)
$dati = array(
	'nome'				=>		$nome,
	'indirizzo'			=>		$indirizzo,
	'tel'				=>		$tel,
	'fax'				=>		$fax,
	'piva'				=>		$piva,
	'spedizione_mezzo'	=>		$spedizione_mezzo,
	'pagamento'			=>		$pagamento,
	'banca'				=>		$banca,
	'abi'				=>		$abi,
	'cab'				=>		$cab,
	'porto'				=>		$porto,
	'consegna_decorrenza'=>		$consegna_decorrenza,
	'agente'			=>		$agente,
	'note'				=>		$note,
	'data'				=>		$data,
	'n'					=>		$n
);

// query che salva i valori precedentemente dichiarati nel database
$salva = executeQuery("INSERT INTO clienti
			(nome, indirizzo, tel, fax, piva, spedizione_mezzo, pagamento, banca, abi, cab, porto, consegna_decorrenza, agente, note, data, n) 
	VALUES 	(:nome, :indirizzo, :tel, :fax, :piva, :spedizione_mezzo, :pagamento, :banca, :abi, :cab, :porto, :consegna_decorrenza, :agente, :note, :data, :n);
	-- memorizziamo nella variabile @last_id l'id del cliente per utilizzarlo successivamente nell'archiviazione delle commissioni
	SET @last_id = last_insert_id();
			", $dati, $conn);

?>

<!-- tabella relativa alle commizzioni -->
<br><br>
<table>
	<tr>
		<th>Modello / Model</th>
		<th>Tessuto / Fabric</th>
		<th>Colore / Colour</th>
		<th>Taglia / Size</th>
		<th>Totale / Total</th>
		<th>Prezzo / Price &euro;</th>
	</tr>

	<?php
	// cicliamo il primo sub array dei dati passati in post che contiene tutti gli array delle commissioni
	foreach ($_POST['commissioni'][0] as $commissione) {

		// archiviamo i dati della singola commissione in un array che utilizzeremo per salvare i dati nel database
		$dati = array(
			'modello'		=>		!empty($commissione[0]['value']) ? $commissione[0]['value'] : "N/D",
			'tessuto'		=>		!empty($commissione[1]['value']) ? $commissione[1]['value'] : "N/D",
			'colore'		=>		!empty($commissione[2]['value']) ? $commissione[2]['value'] : "N/D",
			'misura'		=>		!empty($commissione[3]['value']) ? $commissione[3]['value'] : "N/D",
			'totale'		=>		!empty($commissione[4]['value']) ? $commissione[4]['value'] : "N/D",
			'prezzo'		=>		!empty($commissione[5]['value']) ? $commissione[5]['value'] : "N/D"
		);
		// eseguiamo la query per salvare i dati
		$salva = executeQuery("INSERT INTO commissioni
					(id_cliente, modello, tessuto, colore, misura, totale, prezzo) 
			VALUES 	(@last_id, :modello, :tessuto, :colore, :misura, :totale, :prezzo);
					", $dati, $conn);

		// stampiamo a video i dati appena salvati creando una nuova riga nella tabella
		echo"<tr>";
		// modello
		if ( !empty($commissione[0]['value']) ) {
			echo "<td>".$commissione[0]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		// tessuto
		if ( !empty($commissione[1]['value']) ) {
			echo "<td>".$commissione[1]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		// colore
		if ( !empty($commissione[2]['value']) ) {
			echo "<td>".$commissione[2]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		// misura
		if ( !empty($commissione[3]['value']) ) {
			echo "<td>".$commissione[3]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		// totale
		if ( !empty($commissione[4]['value']) ) {
			echo "<td>".$commissione[4]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		// prezzo
		if ( !empty($commissione[5]['value']) ) {
			echo "<td>".$commissione[5]['value']."</td>";
		} else { echo "<td>N/D</td>"; }

		echo "</tr>";
		}
	?>
</table>
