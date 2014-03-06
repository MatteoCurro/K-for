<?php

$config = array(
	'username' => 'root',
	'password' => 'root',
	'database' => 'kfor'
);

function connect($config)
{
	try {
		$conn = new \PDO('mysql:host=localhost;dbname=' . $config['database'],
						$config['username'],
						$config['password']);

		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}


function query($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	$results = $stmt->fetchAll();

	return $results ? $results : false;
}

function executeQuery($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$response = $stmt->execute($bindings);

	return $response;
}


function get($tableName, $conn, $limit = 10)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName LIMIT $limit");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}
}


function get_by_id($id, $table, $conn)
{
	return query(
		'SELECT * FROM :table WHERE id = :id LIMIT 1',
		array(	'id'	=>	$id,
				'table'	=>	$table),
		$conn
	);
}
