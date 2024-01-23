<?php
include 'Peliculas.php';

$api_url = "http://127.0.0.1:8000/api/";
$peliculas = new Peliculas($api_url);

// Verificar si la lista de géneros está vacía
if (!isset($_SESSION['generos']) || empty($_SESSION['generos'])) {
    $peliculasData = $peliculas->obtenerPeliculas();

    // Obtener géneros disponibles
    $generos = array_unique(array_reduce($peliculasData, function($carry, $pelicula) {
        $generosPelicula = explode(', ', $pelicula['genero']);
        return array_merge($carry, $generosPelicula);
    }, []));
    $generos = array_values(array_filter($generos)); // Eliminar duplicados y reindexar

    // Almacenar la lista de géneros en la sesión para futuras solicitudes
    $_SESSION['generos'] = $generos;
} else {
    // Utilizar la lista de géneros almacenada en la sesión
    $generos = $_SESSION['generos'];
}

// Verificar si la lista de estudios está vacía
if (!isset($_SESSION['estudios']) || empty($_SESSION['estudios'])) {
    // Obtener todas las películas para inicializar la lista de estudios
    $peliculasData = $peliculas->obtenerPeliculas();

    // Obtener estudios disponibles
    $estudios = array_unique(array_column($peliculasData, 'estudio'));
    $estudios = array_values(array_filter($estudios)); // Eliminar duplicados y reindexar

    // Almacenar la lista de estudios en la sesión para futuras solicitudes
    $_SESSION['estudios'] = $estudios;
} else {
    $estudios = $_SESSION['estudios'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $generoSeleccionado = $_POST['genero'];
    $nombreBusqueda = $_POST['nombre'];
    $estudioSeleccionado = $_POST['estudio'];

    $peliculasData = $peliculas->obtenerPeliculas($generoSeleccionado);

    if (!empty($nombreBusqueda)) {
        $peliculasData = array_filter($peliculasData, function($pelicula) use ($nombreBusqueda) {
            return stripos($pelicula['nombre'], $nombreBusqueda) !== false;
        });
    }

    if (!empty($estudioSeleccionado)) {
        $peliculasData = array_filter($peliculasData, function($pelicula) use ($estudioSeleccionado) {
            return stripos($pelicula['estudio'], $estudioSeleccionado) !== false;
        });
    }
} else {
    // Si no se ha enviado un formulario de filtrado, obtener todas las películas
    $peliculasData = $peliculas->obtenerPeliculas();
}

function usuarioLoggeado() {
    //logica
    return true; 
}

function truncateOverview($sinopsis, $limit = 50, $trail = '...') {
    $words = explode(' ', $sinopsis);

    $words = array_map(function($word) {
        return $word != null ? $word : "none";
    }, $words);

    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . $trail;
    } else {
        return implode(' ', $words);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Video</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="title-container">
            <span class="navbar-brand"> MOVIE STORE</span>
        </div>
        <div class="container">
            <div class="navbar-items">
                <form id="filtroForm" method="post">
                    <select id="genero" name="genero">
                        <option value="">Todas las Películas</option>
                        <?php
                        foreach ($generos as $genero) {
                            echo '<option value="' . $genero . '"' . (isset($generoSeleccionado) && $genero == $generoSeleccionado ? ' selected' : '') . '>' . $genero . '</option>';
                        }
                        ?>
                    </select>
                    
                    <select id="estudio" name="estudio">
                        <option value="">Todos los Estudios</option>
                        <?php
                        foreach ($estudios as $estudio) {
                            echo '<option value="' . $estudio . '"' . (isset($estudioSeleccionado) && $estudio == $estudioSeleccionado ? ' selected' : '') . '>' . $estudio . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" name="nombre" placeholder="Buscar por nombre" value="<?php echo isset($nombreBusqueda) ? $nombreBusqueda : ''; ?>">
                    <button type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <div class="login">
            <a href="login.php" class="navbar-login">Iniciar Sesión</a>
        </div>
    </nav>
    
    <div class="card-container">
        <?php
        if (isset($peliculasData["error"])) {
            echo $peliculasData["error"];
        } else {
            foreach ($peliculasData as $pelicula) {
                echo '<div class="card">' . PHP_EOL;
                echo '<img src="' . $pelicula['imagen'] . '" class="card-img-top" alt="..." />' . PHP_EOL;
                echo '<div class="card-body">' . PHP_EOL;
                echo '<h2 class="card-title">' . $pelicula['nombre'] . '</h2>' . PHP_EOL;
                echo '<p class="description card-text">' . truncateOverview($pelicula['sinopsis'], 30, ' ...') . PHP_EOL;

                echo '<div class="list-group-flush">' . PHP_EOL;
                echo '<li class="description list-group-item" data-categoria="genero"><span class="categorization">Género: </span>' . ($pelicula['genero'] != null ? $pelicula['genero'] : "none") . '</li>' . PHP_EOL;
                echo '<li class="description list-group-item" data-categoria="estudio"><span class="categorization">Estudio: </span>' . ($pelicula['estudio'] != null ? $pelicula['estudio'] : "none") . '</li>' . PHP_EOL;
                echo '<li class="description list-group-item"><span class="categorization">Año: </span> ' . ($pelicula['año'] != null ? $pelicula['año'] : "none") . '</li>' . PHP_EOL;
                echo '<li class="description list-group-item"><span class="categorization">Director: </span>' . ($pelicula['director'] != null ? $pelicula['director'] : "none") . '</li>' . PHP_EOL;
                echo '</div>' . PHP_EOL;

                echo '</div>' . PHP_EOL;
                echo '<div class="card-body">' . PHP_EOL;
                if (usuarioLoggeado()) {
                    echo '<button class="btn btn-reservar" data-id="' . $pelicula['id'] . '">Reservar</button>' . PHP_EOL;
                    echo '<button class="btn btn-carrito" data-id="' . $pelicula['id'] . '">Agregar al Carrito</button>' . PHP_EOL;
                } else {
                    echo '<button class="btn btn-reservar" data-id="' . $pelicula['id'] . '" onclick="mostrarAlerta()">Reservar</button>' . PHP_EOL;
                    echo '<button class="btn btn-carrito" data-id="' . $pelicula['id'] . '" onclick="mostrarAlerta()">Agregar al Carrito</button>' . PHP_EOL;
                }
                echo '</div>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
            }
        }
        ?>
    </div>

    <script>
        function mostrarAlerta() {
            alert("Por favor, inicia sesión para realizar esta acción.");
            window.location.href = "login.php";
        }
        
        function filtrarPorGenero() {
            document.getElementById("filtroForm").submit();
        }
    </script>
</body>
</html>
