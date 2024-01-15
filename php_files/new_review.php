<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reseña</title>
</head>
<body>
<?php
include 'send_request.php';
include 'cont_op_p.php';

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

<h1>Formulario de Reseña</h1>

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

</body>
</html>
