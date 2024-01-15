<?php
function sendRequest($endpoint,$context_options){
    // Crea el contexto para la solicitud
    $contexto = stream_context_create($context_options);

    // Realiza la solicitud y obtiene la respuesta
    $respuesta = file_get_contents($endpoint, false, $contexto);

    // Imprime la respuesta o realiza otras operaciones según tus necesidades
    return $respuesta;
}
