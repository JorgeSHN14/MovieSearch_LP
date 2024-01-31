<?php
include 'Peliculas.php';

$api_url = "http://127.0.0.1:8000/api/";
$peliculas = new Peliculas($api_url);

// Verificar si se ha proporcionado un ID de película válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Error: ID de película no válido.";
    exit();
}

$pelicula_id = $_GET['id'];
$detallesPelicula = $peliculas->obtenerDetallesPelicula($pelicula_id);

if (!$detallesPelicula) {
    echo "Error: No se pudieron obtener los detalles de la película.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votar Película</title>
    <link rel="stylesheet" href="stylePaula3.css">
</head>
<body>
    <div class="card">
        <img src="<?php echo $detallesPelicula['imagen']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h2 class="card-title"><?php echo $detallesPelicula['nombre']; ?></h2>
            <p class="description card-text"><?php echo $detallesPelicula['sinopsis']; ?></p>

            <div class="list-group-flush">
                <li class="description list-group-item" data-categoria="genero">
                    <span class="categorization">Género: </span>
                    <?php echo ($detallesPelicula['genero'] != null ? $detallesPelicula['genero'] : "none"); ?>
                </li>
                <li class="description list-group-item" data-categoria="estudio">
                    <span class="categorization">Estudio: </span>
                    <?php echo ($detallesPelicula['estudio'] != null ? $detallesPelicula['estudio'] : "none"); ?>
                </li>
                <li class="description list-group-item">
                    <span class="categorization">Año: </span>
                    <?php echo ($detallesPelicula['año'] != null ? $detallesPelicula['año'] : "none"); ?>
                </li>
                <li class="description list-group-item">
                    <span class="categorization">Director: </span>
                    <?php echo ($detallesPelicula['director'] != null ? $detallesPelicula['director'] : "none"); ?>
                </li>
            </div>
        </div>

        <div class="card-body">
            <!-- Barra con estrellas -->
            <div class="rating-container">
                <span class="rating-label">Calificación:</span>
                <div class="rating-stars">
                    <div class="star" data-rating="1">&#9733;</div>
                    <div class="star" data-rating="2">&#9733;</div>
                    <div class="star" data-rating="3">&#9733;</div>
                    <div class="star" data-rating="4">&#9733;</div>
                    <div class="star" data-rating="5">&#9733;</div>
                </div>
            </div>

            <!-- GridPane de comentarios -->
            <div class="comments-container">
                <h3>Comentarios:</h3>
                <div class="grid-pane">
                    <!-- Ejemplo de comentario -->
                    <div class="comment">
                        <strong>Usuario:</strong> Me encanto la trama de la pelicula y su originalidad
                    </div>
                </div>
            </div>

            <?php
            ?>

        </div>
    </div>
</body>
</html>
