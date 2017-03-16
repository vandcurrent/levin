<?php

header('Content-Type: application/json');

// Set up the ORM library
require_once('graph-conn.php');

if (isset($_GET['start']) AND isset($_GET['end'])) {
	
	$start = $_GET['start'];
	$end = $_GET['end'];
	$data = array();

	// Select the results with Idiorm
	$results = ORM::for_table('penjualan')
			->where_gte('tanggal', $start)
			->where_lte('tanggal', $end)
			->order_by_desc('tanggal')
			->find_array();


	// Build a new array with the data
	foreach ($results as $key => $value) {
		$data[$key]['label'] = $value['tanggal'];
		$data[$key]['value'] = $value['banyaknya'];
	}

	echo json_encode($data);
}
