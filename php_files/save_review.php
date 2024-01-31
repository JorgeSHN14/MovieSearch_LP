<?php
function agregarComentario($id, $comentario, $calificacion) {
    // Obtener el contenido actual del archivo o un array vacío si el archivo no existe
    $reviews = file_exists('review.json') ? json_decode(file_get_contents('review.json'), true) : [];

    // Verificar si ya existe un comentario con el mismo ID
    $comentarioExistente = array_search($id, array_column($reviews, 'id'));

    if ($comentarioExistente !== false) {
        // Si ya existe un comentario con el mismo ID, actualizar el comentario y calificación
        $reviews[$comentarioExistente]['comentario'] = $comentario;
        $reviews[$comentarioExistente]['calificacion'] = $calificacion;
    } else {
        // Si no existe un comentario con el mismo ID, agregar uno nuevo
        $nuevoComentario = [
            'id' => $id,
            'comentario' => $comentario,
            'calificacion' => $calificacion,
        ];

        $reviews[] = $nuevoComentario;
    }

    // Guardar los comentarios actualizados en el archivo
    file_put_contents('review.json', json_encode($reviews, JSON_PRETTY_PRINT));

    // Puedes retornar algo si lo necesitas
    return 'Comentario agregado exitosamente.';
}

function mostrarComentarios($id) {
    // Obtener el contenido actual del archivo o un array vacío si el archivo no existe
    $reviews = file_exists('review.json') ? json_decode(file_get_contents('review.json'), true) : [];

    // Filtrar los comentarios por ID de película
    $comentariosPelicula = array_filter($reviews, function ($c) use ($id) {
        return $c['id'] == $id;
    });

    // Crear la lista HTML de comentarios
    $htmlLista = '<ul>';
    foreach ($comentariosPelicula as $comentario) {
        $htmlLista .= '<li>';
        $htmlLista .= '<strong>Comentario:</strong> ' . $comentario['comentario'] . '<br>';
        $htmlLista .= '<strong>Calificación:</strong> ' . $comentario['calificacion'];
        $htmlLista .= '</li>';
    }
    $htmlLista .= '</ul>';

    return $htmlLista;
}
?>