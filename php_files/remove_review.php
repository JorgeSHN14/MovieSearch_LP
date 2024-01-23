<?php
include 'send_request.php';
include 'cont_op_.php';

// Función para eliminar reseñas
function eliminarResena($pelicula, $usuario) {
    $endpoint = "http://127.0.0.1:8000/api/resenas/{$pelicula}/{$usuario}";
    $context_options = contextOptionsP([], 'DELETE');
    $response = sendRequest($endpoint, $context_options);

    return $response;
}

// Verifica si se proporcionan los parámetros de película y usuario
if (isset($_GET['pelicula']) && isset($_GET['usuario'])) {
    $pelicula = $_GET['pelicula'];
    $usuario = $_GET['usuario'];

    $resultado = eliminarResena($pelicula, $usuario);
    echo $resultado;
} else {
    echo "Por favor, proporciona película e usuario";
}

