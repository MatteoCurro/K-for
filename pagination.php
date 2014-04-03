<?php
	// ///////////////////////////////////////////
	// ///////////////////////////////////////////
	// 					PAGINATION
	// ///////////////////////////////////////////
	// ///////////////////////////////////////////

	// se non è impostata la pagina imposto la prima
	// NB la variabile GET che imposta la pagina è "page=1"
	if ( isset($_GET['page']) && !empty($_GET['page']) ) {
		$pagenum = (int)$_GET['page'];
	} else {
		$pagenum = 1;
	}
	// ottengo il numero di risultatati
	if(count($conditions)) {
		$rows = query(
		            "SELECT id FROM clienti WHERE ".implode(' AND ', $conditions),
		            $conditions, $conn);
	} else {
		$rows = 'SELECT id FROM clienti ORDER BY id DESC';
	}
	// salvo il totale di risultati
	$rows = count($rows);

	// risultati per pagina
	$page_rows = 100;

	// ottengo l'ultima pagina
	$last = ceil($rows/$page_rows);

	// verifico che la pagina non sia negativa
	if ($pagenum < 1) {
		$pagenum = 1;
	} elseif ($pagenum > $last) {
		$pagenum = $last;
	}

	// imposto la parte della query che gestisce il limite di risultati visualizzati
	$max = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;