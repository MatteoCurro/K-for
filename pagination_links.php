
<?php
/* Set current, prev and next page */
$prev = ($pagenum - 1);
$next = ($pagenum + 1);

$pagination = '';

/* Create a PREV link if there is one */
if($pagenum > 1) {
	$pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$prev.'" class="pagination">Precedente</a> ';
}

/* Loop through the total pages */
for($i = 1; $i <= $last; $i++) {
	if(($pagenum) == $i) {
	    $pagination .= " <a class='pagination current'>$i</a> ";
	} else {
	    $pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$i.'" class="pagination">'.$i.'</a> ';
	}
}

/* Print NEXT link if there is one */
if($pagenum < $last) {
	$pagination .= ' <a href="?'.getCurrentGetParams().'&page='.$next.'" class="pagination">Successiva</a> ';
}

echo "$pagination";