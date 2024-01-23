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

    private function filtrarPorGenero($peliculas, $genero) {
        if ($genero === null || $genero === '') {
            return $peliculas;
        }

        return array_filter($peliculas, function($pelicula) use ($genero) {
            $generosPelicula = explode(', ', $pelicula['genero']);
            return in_array($genero, $generosPelicula);
        });
    }


    public function realizarReservaDesdeCliente($pelicula_id, $usuario_id) {
        $url = $this->api_url . "reservar/{$pelicula_id}/{$usuario_id}/";
        $respuesta = $this->realizarSolicitud($url);
        $this->mostrarAlerta($respuesta);
    }

    public function agregarAlCarritoDesdeCliente($pelicula_id, $usuario_id) {
        $url = $this->api_url . "agregar_al_carrito/{$pelicula_id}/{$usuario_id}/";
        $respuesta = $this->realizarSolicitud($url);
        $this->mostrarAlerta($respuesta);
    }

    public function comprarDesdeCliente($pelicula_id, $usuario_id) {
        $url = $this->api_url . "comprar/{$pelicula_id}/{$usuario_id}/";
        $respuesta = $this->realizarSolicitud($url);
        $this->mostrarAlerta($respuesta);
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
