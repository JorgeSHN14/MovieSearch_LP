<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Comentario</title>
    <link rel="stylesheet" type="text/css" href="./css/stylePaula2.css">
</head>
<body>

<?php

// include 'send_request.php';

function eliminarResena($pelicula, $usuario) {
    $endpoint = "http://127.0.0.1:8000/api/resenas/{$pelicula}/{$usuario}";
    $context_options = contextOptionsP([], 'DELETE');
    $response = sendRequest($endpoint, $context_options);

    return $response;
}

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
    Remover Comentario
</div>

<?php

$data = json_decode(file_get_contents('../data.json'), true);


$peliculaEncontrada = null;
foreach ($data as $item) {
    if ($item['modelo'] === 'peliculas' && $item['fields']['nombre'] === 'Spider-Man: No Way Home') {
        $peliculaEncontrada = $item['fields'];
        break;
    }
}


if ($peliculaEncontrada) {
    echo '<div class="movie-title">';
    echo '    <h2>' . $peliculaEncontrada['nombre'] . '</h2>';
    echo '</div>';

    echo '<div class="movie-image">';
    echo '    <img src="' . $peliculaEncontrada['imagen'] . '" alt="Imagen de la Película">';
    echo '</div>';
}

?>

<!-- Gridpane con comentarios -->
<div class="previous-reviews">
    <div class="scroll-reviews">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <div class="review-container">
                <div class="review-card" data-review-id="<?= $i ?>">
                    <div class="review-content">
                        <img class="user-avatar-small" src="./src/kha.jpg" alt="Avatar de usuario">
                        <p class="review-text-small">Muy bonita. Estuvo entretenido.</p>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

    <!-- Panel para eliminar comentario -->
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
</body>
</html>
