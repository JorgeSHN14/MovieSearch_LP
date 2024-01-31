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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $endpoint = 'http://127.0.0.1:8000/api/resenas/';

    $pelicula = $_POST['pelicula'];
    $usuario = $_POST['usuario'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $data = array(
        "pelicula" => $pelicula,
        "usuario" => $usuario,
        "calificacion" => $calificacion,
        "comentario" => $comentario
    );

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
        <img class="movie-image" src="./src/passengers.jpg" alt="Imagen de la pelicula">
        <p class="movie-title"> Passengers</p>
    </div>
    
    <div class="line-divider"></div>

    <div class="review-form">
        <form method="post" action="">
            <label for="pelicula">Película:</label>
            <select name="pelicula" required>
                <?php
                $peliculas_json = file_get_contents('http://127.0.0.1:8000/api/peliculas/');
                $peliculas = json_decode($peliculas_json, true);

                foreach ($peliculas as $pelicula) {
                    echo "<option value=\"{$pelicula['id']}\">{$pelicula['nombre']}</option>";
                }
                ?>
            </select><br>

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

</body>
</html>