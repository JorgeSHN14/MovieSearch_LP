<?php
include 'Peliculas.php';

echo "Tienda Video" . PHP_EOL;
echo "-----------------" . PHP_EOL;

$api_url = "http://127.0.0.1:8000/api/";  // Ajusta según la URL de tu API
$peliculas = new Peliculas($api_url);

// Resto del código de index.php (menú, opciones, etc.)
echo "Bienvenido!" . PHP_EOL;

// Menú principal
echo "1. Mostrar Todas las Películas" . PHP_EOL;
echo "2. Filtrar Películas" . PHP_EOL;
echo "3. Reservar" . PHP_EOL;

// Lee la opción del usuario
echo "Selecciona una opción: ";
$opcion = trim(fgets(STDIN));

switch ($opcion) {
    case 1:
        $peliculas->mostrarPeliculas();
        break;
    case 2:
        // Solicitar los criterios de filtrado
        echo "Ingresa el género (opcional): ";
        $genero = trim(fgets(STDIN));
        echo "Ingresa el año (opcional): ";
        $anio = trim(fgets(STDIN));

        // Mostrar películas con los filtros proporcionados
        $peliculas->mostrarPeliculas($genero, $anio);
        break;
    case 3:
        // Solicitar los detalles para la reserva
        echo "Ingresa el ID de la película: ";
        $peliculaId = trim(fgets(STDIN));
        echo "Ingresa la fecha de reserva (YYYY-MM-DD): ";
        $fechaReserva = trim(fgets(STDIN));

        // Realizar la reserva
        $peliculas->realizarReserva($peliculaId, "usuario_demo", $fechaReserva);
        break;
    default:
        echo "Opción no válida." . PHP_EOL;
}
?>
