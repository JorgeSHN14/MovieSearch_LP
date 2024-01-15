<?php

class Peliculas {
    private $api_url;

    public function __construct($api_url) {
        $this->api_url = $api_url;
    }

    public function estaAutenticado() {
        //return isset($_SESSION['usuario']);
        return true;
    }

    public function mostrarPeliculas($genero = null, $anio = null) {
        if (!$this->estaAutenticado()) {
            echo "Por favor, inicia sesión primero." . PHP_EOL;
            return;
        }
    
        $url = $this->api_url . "peliculas/";
    
        // Agregar parámetros de filtro si se proporcionan
        if ($genero !== null || $anio !== null) {
            $url .= "?";
            if ($genero !== null) {
                $url .= "genero=$genero";
                if ($anio !== null) {
                    $url .= "&";
                }
            }
            if ($anio !== null) {
                $url .= "anio=$anio";
            }
        }
    
        // Simular la solicitud a la API
        $peliculas = json_decode(file_get_contents($url), true);
    
        if (!empty($peliculas)) {
            foreach ($peliculas as $pelicula) {
                echo "Película:" . PHP_EOL;
                foreach ($pelicula as $key => $value) {
                    echo "  " . ucfirst($key) . ": " . $value . PHP_EOL;
                }
                echo PHP_EOL;
            }
        } else {
            echo "No se encontraron películas con los filtros seleccionados." . PHP_EOL;
        }
    }
    
    public function realizarReserva($nombrePelicula, $usuario) {
        if (!$this->estaAutenticado()) {
            echo "Por favor, inicia sesión primero." . PHP_EOL;
            return;
        }
    
        // Obtener la información de la película por nombre
        $urlPeliculas = $this->api_url . "peliculas/?nombre=" . urlencode($nombrePelicula);
        $peliculas = json_decode(file_get_contents($urlPeliculas), true);
    
        if (empty($peliculas)) {
            echo "No se encontró la película con el nombre proporcionado." . PHP_EOL;
            return;
        }
    
        // Tomar la primera película encontrada (puedes ajustar esto según tus requisitos)
        $pelicula = $peliculas[0];
    
        // Realizar la reserva
        $urlReservas = $this->api_url . "resenas/";
        $data = array(
            'pelicula' => $pelicula['id'],
            'usuario' => $usuario
        );
    
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ),
        );
    
        $context = stream_context_create($options);
        $result = file_get_contents($urlReservas, false, $context);
    
        if ($result !== false) {
            echo "Reserva realizada con éxito." . PHP_EOL;
        } else {
            echo "Error al realizar la reserva." . PHP_EOL;
            // Imprimir el mensaje de error proporcionado por el servidor
            if (isset($http_response_header[0]['uri'])) {
                echo file_get_contents($http_response_header[0]['uri']) . PHP_EOL;
            }
        }
    }
    
    
    
}
?>
