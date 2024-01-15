<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>
<body>
<?php
include 'send_request.php';
include 'cont_op_p.php';
// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $endpoint = 'http://127.0.0.1:8000/api/peliculas/';
    // Recupera los datos del formulario
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $elenco_principal = $_POST['elenco_principal'];
    $director = $_POST['director'];
    $sinopsis = $_POST['sinopsis'];
    $estudio = $_POST['estudio'];
    
    // Verifica si se ha cargado un archivo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        move_uploaded_file($imagen_temporal, $imagen_nombre);
    } else {
        $imagen_nombre = null;
    }

    // Construye el array de datos
    $data = array(
        "nombre" => $nombre,
        "genero" => $genero,
        "año" => $ano,
        "elenco_principal" => $elenco_principal,
        "director" => $director,
        "sinopsis" => $sinopsis,
        "estudio" => $estudio,
        "imagen" => $imagen_nombre
    );
    $context_options = contextOptionsP($data, $_SERVER['REQUEST_METHOD']);
    
    $response = sendRequest($endpoint, $context_options);
    echo $response;
}
?>

<h1>Formulario de Película</h1>

<form method="post" action="">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="genero">Género:</label>
    <input type="text" name="genero" required><br>

    <label for="ano">Año:</label>
    <input type="number" name="ano" required><br>

    <label for="elenco_principal">Elenco Principal:</label>
    <input type="text" name="elenco_principal" required><br>

    <label for="director">Director:</label>
    <input type="text" name="director" required><br>

    <label for="sinopsis">Sinopsis:</label>
    <textarea name="sinopsis" required></textarea><br>

    <label for="estudio">Estudio:</label>
    <input type="text" name="estudio" required><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen"><br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>
