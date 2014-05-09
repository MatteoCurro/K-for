<?php

function view($path, $data = null) 
{
	if ( $data ) {
		extract($data);
	}
	include "views/{$path}.view.php";
}

function getCurrentGetParams() {
	if (!empty($_GET)) {
		$link = '';
	    // Loop through the parameters
	    foreach ($_GET as $parameter => $value) {
	    	if($parameter != 'page') {
	      		// Append the parameter and its value to the new path
	      		$link .= "&" . $parameter . "=" . urlencode($value);
	  		}
	    }
	    return $link;
	}
}

function getAlertView($type, $days, $conn) {
	$alert = getAlert($type, $days, $conn);
	if ($alert) {
		return '<span class="alert">'.$alert.'</span>';
	}
}

