<?php
include 'send_request.php';
include 'cont_op_delete.php';
$idMovieToDelete = 4;
$endpoint = 'http://127.0.0.1:8000/api/peliculas/' . $idMovieToDelete . '/';
$context_options = contextOptionsDelete();
$response = sendRequest($endpoint, $context_options);
echo $response;

