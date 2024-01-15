<?php
function convertirCalificacionAEstrellas($calificacion) {
    // Lógica para convertir la calificación numérica en estrellas
    $estrellas = "";
    for ($i = 1; $i <= 5; $i++) {
        $estrellas .= ($i <= $calificacion) ? "★" : "☆";
    }
    return $estrellas;
}

// Ejemplo Prueba
$calificacionEjemplo = 3;
$estrellas = convertirCalificacionAEstrellas($calificacionEjemplo);
echo "Calificación: $estrellas";

