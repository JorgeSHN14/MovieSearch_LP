<?php

class Peliculas {
    private $api_url;

    public function __construct($api_url) {
        $this->api_url = $api_url;
    }

    public function estaAutenticado() {
        // return isset($_SESSION['usuario']);
        return true;
    }

    
    public function obtenerPeliculas($genero = null) {
        if (!$this->estaAutenticado()) {
            return array("error" => "Por favor, inicia sesión primero.");
        }

        $url = $this->api_url . "peliculas/";

        $peliculas = json_decode(file_get_contents($url), true);

        if (!empty($peliculas)) {
            return $this->filtrarPorGenero($peliculas, $genero);
        } else {
            return array("error" => "No se encontraron películas.");
        }
    }

    public function obtenerDetallesPelicula($pelicula_id) {
        if (!$this->estaAutenticado()) {
            return array("error" => "Por favor, inicia sesión primero.");
        }

        $url = $this->api_url . "peliculas/{$pelicula_id}";

        $detallesPelicula = json_decode(file_get_contents($url), true);

        if (!empty($detallesPelicula)) {
            return $detallesPelicula;
        } else {
            return array("error" => "No se encontraron detalles de la película.");
        }
    }
    
    private function filtrarPorGenero($peliculas, $genero) {
        if ($genero === null || $genero === '') {
            return $peliculas;
        }

        return array_filter($peliculas, function($pelicula) use ($genero) {
            $generosPelicula = explode(', ', $pelicula['genero']);
            return in_array($genero, $generosPelicula);
        });
    }


    public function realizarReservaDesdeCliente($pelicula_id) {
        // Temporalmente usando un ID de usuario quemado
        $usuarioId = 1; 
    
        $url = $this->api_url . "reservas/";
        $data = array('pelicula_id' => $pelicula_id, 'usuario_id' => $usuarioId);
        $respuesta = $this->realizarSolicitud($url, $data);
    
        $this->mostrarAlerta($respuesta);
    }
    

    public function mostrarReservasCliente() {
        // Temporalmente usando un ID de usuario quemado
        $usuarioId = 1; 
    
        $urlReservas = $this->api_url . "reservas/";
        $dataReservas = array('usuario_id' => $usuarioId);
        $reservas = json_decode($this->realizarSolicitud($urlReservas, $dataReservas), true);
    
        // Verificar si hay reservas
        if (empty($reservas)) {
            return array("error" => "No se encontraron reservas para el usuario.");
        }
    
        // Obtener los detalles de las películas correspondientes a las reservas
        $urlPeliculas = $this->api_url . "peliculas/";
        $peliculas = json_decode(file_get_contents($urlPeliculas), true);
    
        // Crear un array asociativo para facilitar la búsqueda por ID de película
        $peliculasIndexadas = array_column($peliculas, null, 'id');
    
        // Combina los detalles de la reserva con los detalles de la película
        foreach ($reservas as &$reserva) {
            $peliculaId = $reserva['pelicula'];
            if (isset($peliculasIndexadas[$peliculaId])) {
                $reserva['pelicula_detalle'] = $peliculasIndexadas[$peliculaId];
            }
        }try {
            $result = file_get_contents($url, false, $context);
            return $result;
        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, mostrar un mensaje de error
            return "Error al realizar la solicitud: " . $e->getMessage();
        }
    
        return $reservas;
    }
    

    public function agregarAlCarritoDesdeCliente($pelicula_id, $usuario_id) {
       
    }

    public function comprarDesdeCliente($pelicula_id, $usuario_id) {

    }

    private function realizarSolicitud($url, $data = array()) {
        // Lógica para realizar la solicitud POST a la API
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }

    private function mostrarAlerta($mensaje) {
        echo "<script>alert('$mensaje');</script>";
    }
}

?>
