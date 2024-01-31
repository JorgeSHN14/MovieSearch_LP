<?php
include 'send_request.php';
include 'cont_op_delete.php';
function removeMovie($idMovie) {
    $endpoint = 'http://127.0.0.1:8000/api/peliculas/' . $idMovie. '/';
    $context_options = contextOptionsDelete();
    $response = sendRequest($endpoint, $context_options);
    // header("Location: index.php");
    // exit();

}

