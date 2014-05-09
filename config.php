<?php

require 'config/functions.php';
require 'config/db.php';

// Connect to the db
$conn = connect($config);
if ( $conn ) {
	// echo "Connesso";
} else {
	die('Problem connecting to the db.');
}

