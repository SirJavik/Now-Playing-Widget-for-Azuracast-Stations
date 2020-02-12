<?php

/* ------------------------------------------------------------------------ *
 * Request data
 * ------------------------------------------------------------------------ */
$filters = [
	'instance'  => FILTER_SANITIZE_URL,
	'stationid' => FILTER_SANITIZE_NUMBER_INT,
];
$requestdata = filter_input_array(INPUT_POST, $filters);

/* ------------------------------------------------------------------------ *
 * Loading options
 * ------------------------------------------------------------------------ */
$azuracast = $requestdata['instance'] . "/api/nowplaying/" . $requestdata['stationid'];
$azuracast_data = json_decode(file_get_contents($azuracast), true)['now_playing']['song'];

/* ------------------------------------------------------------------------ *
 * Deleting unnecessary data
 * ------------------------------------------------------------------------ */
unset($azuracast_data['id']);
unset($azuracast_data['text']);
unset($azuracast_data['lyrics']);
unset($azuracast_data['custom_fields']);

/* ------------------------------------------------------------------------ *
 * Filtering remote data
 * ------------------------------------------------------------------------ */
$filters = [
	'artist' => FILTER_SANITIZE_STRING,
	'album'  => FILTER_SANITIZE_STRING,
	'title'  => FILTER_SANITIZE_STRING,
	'art'    => FILTER_SANITIZE_URL
];

$azuracast_data = filter_var_array($azuracast_data, $filters);

/* ------------------------------------------------------------------------ *
 * Return JSON
 * ------------------------------------------------------------------------ */
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($azuracast_data);

