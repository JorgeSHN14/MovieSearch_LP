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
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $pelicula = $_GET['id'];

    $endpoint = "http://127.0.0.1:8000/api/peliculas/$pelicula";
    $respuesta = file_get_contents($endpoint); 
    $pelicula = json_decode($respuesta, true);
    //print_r($pelicula);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pelicula = $_POST['id'];

    $endpoint = "http://127.0.0.1:8000/api/peliculas/$pelicula";
    $respuesta = file_get_contents($endpoint); 
    $pelicula = json_decode($respuesta, true);

    //print_r($_POST);
    if(isset($_POST['save_review'])){
        $comentario = $_POST['comentario'];
        $calificacion = $_POST['calificacion'];

        require_once("save_review.php");

        agregarComentario($_POST['id'],$comentario,$calificacion);
    }
}
?>

<div class="title-section">
    <h1> Agregar nueva reseña </h1>
</div>

<div class="form-container">
    <div class="movie-info">
        <img class="movie-image" src="<?php echo $pelicula['imagen'] ?>" alt="Imagen de la pelicula">
        <p class="movie-title"> <?php echo $pelicula['nombre'] ?></p>
    </div>
    
    <div class="line-divider"></div>

    <div class="review-form">
        <form method="post" action="">
            <label for="pelicula">Película:</label> <h1><?php echo $pelicula['nombre'] ?></h1>
            
            
            <label for="calificacion">Calificación:</label>
            <div>
                1<input type="radio" name="calificacion" value="1"> 
                2<input type="radio" name="calificacion" value="2"> 
                3<input type="radio" name="calificacion" value="3" checked> 
                4<input type="radio" name="calificacion" value="4"> 
                5<input type="radio" name="calificacion" value="5"> 
            </div><br>

            <label for="comentario">Comentario:</label>
            <textarea name="comentario" required></textarea><br>

            <input type="submit" name='save_review' value="Enviar">
            <input type="hidden" name='id' value="<?php echo $pelicula['id']?>" >
        </form>
    </div>
</div>

</body>
</html>