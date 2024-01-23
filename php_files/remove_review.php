<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reseña</title>
    <link rel="stylesheet" type="text/css" href="./css/stylePaula2.css">
</head>
<body>

<?php
//include 'send_request.php';
//include 'cont_op_.php';

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
    echo "Proporciona usuario y Pelicula para eliminar un comentario";
}
?>

<div class="header">
    Eliminar Review
</div>

<div class="previous-reviews">

    <div class="scroll-reviews">
        <div class="review-card">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
            <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
        <div class="review-card">
        <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
        <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
        <div class="review-card">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
            <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
        <div class="review-card">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
            <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
        <div class="review-card">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
            <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
        <div class="review-card">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
            <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
        </div>
    </div>

    <div class="review-to-delete">
        <div class="review-card" data-review-id="1">
            <img class="user-avatar" src="./src/kha.jpg" alt="Avatar del usuario">
            <div class="review-text">
                <p>Reseña de usuario Aguacate sobre la película Passengers</p>
                <button class="delete-review">Eliminar</button>
            </div>
        </div>
    </div>    

</div>

<script src="./js/scriptPaula.js"></script>

</body>
</html>

