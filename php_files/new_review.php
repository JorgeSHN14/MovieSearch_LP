<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reseña</title>
    <link rel="stylesheet" type="text/css" href="./css/stylePaula.css">

</head>
<body>
<?php
//include 'send_request.php';
//include 'cont_op_.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $endpoint = 'http://127.0.0.1:8000/api/resenas/';

    
    $pelicula = $_POST['pelicula'];
    $usuario = $_POST['usuario'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    
    // Construye el array de datos
    $data = array(
        "pelicula" => $pelicula,
        "usuario" => $usuario,
        "calificacion" => $calificacion,
        "comentario" => $comentario
    );

    //Convierte el array en formato JSON
    $context_options = contextOptionsP($data, $_SERVER['REQUEST_METHOD']);
    $response = sendRequest($endpoint, $context_options);
    echo $response;
}

?>

<div class="title-section">
    <h1> Agregar nueva reseña </h1>
</div>

<div class="form-container">
    <div class="movie-info">
        <!--Agregar una pelicula por default -->
        <img class="movie-image" src="./src/passengers.jpg" alt="Imagen de la pelicula">
        <p class="movie-title"> Passengers</p>
    </div>
    
    <div class="line-divider"></div>

    <div class="review-form">
        <form method="post" action="">
            <label for="pelicula">Película:</label>
            <input type="text" name="pelicula" required><br>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required><br>

            <label for="calificacion">Calificación:</label>
            <div>
                <input type="radio" name="calificacion" value="1" required> 1
                <input type="radio" name="calificacion" value="2"> 2
                <input type="radio" name="calificacion" value="3"> 3
                <input type="radio" name="calificacion" value="4"> 4
                <input type="radio" name="calificacion" value="5"> 5
            </div><br>

            <label for="comentario">Comentario:</label>
            <textarea name="comentario" required></textarea><br>

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>

<!--Resenas anteriores-->
<div class="previous-reviews">
    <div class="review-card">
        <img class="user-avatar" src="./src/feliz.png" alt="Avatar de usuario">
        <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/feliz.png" alt="Avatar de usuario">
        <p class="review-text">Hola. Estuvo bien creo.</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
        <p class="review-text">Raro a mi parecer</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/feliz.png" alt="Avatar de usuario">
        <p class="review-text">Me gusta lo futurista</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
        <p class="review-text">Me encanto</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
        <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/feliz.png" alt="Avatar de usuario">
        <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
    </div>
    <div class="review-card">
        <img class="user-avatar" src="./src/kha.jpg" alt="Avatar de usuario">
        <p class="review-text">Muy bonita. Estuvo entretenido.</p> 
    </div>

</div>

</body>
</html>
