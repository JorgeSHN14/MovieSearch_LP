//Eliminacion de comentarios
$(document).ready(function() {
    var commentsContainer = $("#commentsContainer");
    var deletePanel = $(".delete-panel");

    // Realizar solicitud AJAX para obtener solo reseñas del archivo data.json
    $.ajax({
        url: '../data.json',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var reviews = data.filter(item => item.modelo === 'resena');

            // Llenar el GridPane con reseñas
            for (var i = 0; i < reviews.length; i++) {
                var reviewCard = $("<div class='review-card'></div>");
                var reviewInfo = reviews[i].fields;

                var reviewText = `
                    <p>Reseña de usuario ${reviewInfo.usuario_id} para la película ${reviewInfo.pelicula_id}:</p>
                    <p>Calificación: ${reviewInfo.calificacion}/5</p>
                    <p>${reviewInfo.comentario}</p>
                `;

                reviewCard.html(reviewText);

                reviewCard.click(function() {
                    // Mostrar el panel de eliminación al hacer clic en una reseña
                    deletePanel.show();
                });

                commentsContainer.append(reviewCard);
            }
        },
        error: function(error) {
            console.error('Error al obtener reseñas:', error);
        }
    });

    // Agregar evento para cerrar el panel de eliminación
    deletePanel.find("button").click(function() {
        deletePanel.hide();
    });
});
