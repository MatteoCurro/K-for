<?php

require 'functions.php';
require 'db.php';

// Connect to the db
$conn = connect($config);
if ( $conn ) {
	// echo "Connesso";
} else {
	die('Problem connecting to the db.');
}
