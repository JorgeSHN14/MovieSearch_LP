<?php
include 'send_request.php';
include 'cont_op_p.php';
$idMovieToDelete = 5;
$endpoint = 'http://127.0.0.1:8000/api/peliculas/' . $idMovieToDelete . '/';
$dataToEdit = array(
    'nombre' => 'Pasajeros',
    'genero' => 'Ciencia Ficcion, Aventura',
);

$context_options = contextOptionsP($dataToEdit,'PATCH');
$response = sendRequest($endpoint,$context_options);
echo $response;