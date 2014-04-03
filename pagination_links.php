
<?php
// Imposto la pagina corrente e quella precedente 
$prev = ($pagenum - 1);
$next = ($pagenum + 1);

// resetto la variabile contenente i links della pagination
$pagination = '';

// Creo un link per la pagina precedente se ne esiste una 
if($pagenum > 1) {
	$pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$prev.'" class="pagination">Precedente</a> ';
}

// ciclo tutte le pagine e creo il link
for($i = 1; $i <= $last; $i++) {
	if(($pagenum) == $i) {
	    $pagination .= " <a class='pagination current'>$i</a> ";
	} else {
	    $pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$i.'" class="pagination">'.$i.'</a> ';
	}
}

// creo un link per la pagina successiva se ne esiste una
if($pagenum < $last) {
	$pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$next.'" class="pagination">Successiva</a> ';
}
// Stampo a video la pagination
echo $pagination;