<?php
function contextOptionsP($data, $method){
    // Convierte el array a formato JSON
    $datos_json = json_encode($data);
    return array(
        'http' => array(
            'method'  => $method,
            'header'  => 'Content-Type: application/json',
            'content' => $datos_json
        )
    );
}
