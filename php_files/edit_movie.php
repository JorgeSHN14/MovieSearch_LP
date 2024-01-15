<?php
include 'send_request.php';
include 'cont_op_p.php';
$idMovieToDelete = 1;
$endpoint = 'http://127.0.0.1:8000/api/peliculas/' . $idMovieToDelete . '/';
$dataToEdit = array(
    'nombre' => 'Como si fuera la primera vez(50 first dates)',
    'genero' => 'Comedia, Romance',
    'elenco_principal' => 'Adam Samdler, Drew Barrymore, Allen Covert',
);

$context_options = contextOptionsP($dataToEdit,'PATCH');
$response = sendRequest($endpoint,$context_options);
echo $response;

