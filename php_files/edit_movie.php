<?php
include 'send_request.php';
include 'cont_op_p.php';
$idMovieToEdit = 10;
$endpoint = 'http://127.0.0.1:8000/api/peliculas/' . $idMovieToEdit . '/';
// $dataToEdit = array(
//     'nombre' => 'Como si fuera la primera vez(50 first dates)',
//     'genero' => 'Comedia, Romance',
//     'elenco_principal' => 'Adam Samdler, Drew Barrymore, Allen Covert',
// );
$dataToEdit = array(
    'imagen' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcR75Eo7baEZrmk84z4Hm_-uk1xY4sMuelbI6FI0X-8ECEydiTBJ',
);

$context_options = contextOptionsP($dataToEdit,'PATCH');
$response = sendRequest($endpoint,$context_options);
echo $response;

