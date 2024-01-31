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

if (!$detallesPelicula || isset($detallesPelicula['error'])) {
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
    <link rel="stylesheet" href="./css/styleJorge.css">
    <link rel="stylesheet" href="./css/stylePaula3.css">
</head>
<body>
<div class="data">
        <div class="preview">
            <div class="flex-center">
                <h2>Previsualización</h2>
            </div>
            <div id="imageContainer">
                <img src="<?php echo $detallesPelicula['imagen']; ?>" id="imagenPrevisualizacion"/>
            </div>
        </div>
        
        <div id="info">
            <div class="field">
                <label for="nombre">Nombre:</label>
                <p><?php echo $detallesPelicula['nombre']; ?></p>
            </div>
            <div class="field">
                <label for="genero">Género:</label>
                <p><?php echo ($detallesPelicula['genero'] != null ? $detallesPelicula['genero'] : "none"); ?></p>
      
            </div>
            <div class="field">
                <label for="ano">Año:</label>
                <p><?php echo ($detallesPelicula['año'] != null ? $detallesPelicula['año'] : "none"); ?></p>
               
            </div>
            <div class="field">
                <label for="elenco_principal">Elenco Principal:</label>
                <p><?php echo ($detallesPelicula['elenco_principal'] != null ? $detallesPelicula['elenco_principal']: "none"); ?></p>
                
            </div>
            <div class="field">
                <label for="director">Director:</label>
                <p><?php echo ($detallesPelicula['director'] != null ? $detallesPelicula['director'] : "none"); ?></p>
            </div>
            <div class="field">
                <label for="sinopsis">Sinopsis:</label>
                <p><?php echo $detallesPelicula['sinopsis']; ?></p>
                
            </div>
            <div class="field">
                <label for="estudio">Estudio:</label>
                <p><?php echo ($detallesPelicula['estudio'] != null ? $detallesPelicula['estudio'] : "none"); ?></p>
            </div>    

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
                        <strong>Usuario:</strong>
                        <?php
                            require_once("save_review.php");
                            echo mostrarComentarios($_GET['id']);
                        ?>
                    </div>
                </div>
            </div>

            <?php
            ?>

        </div>
    </div>
</body>
</html>
