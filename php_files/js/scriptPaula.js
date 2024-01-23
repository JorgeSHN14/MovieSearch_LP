// Manejo de la eliminación de reseñas
$(document).ready(function () {
    $('.delete-review').on('click', function () {
        var reviewId = $(this).closest('.review-card').data('review-id');

        $.ajax({
            type: 'POST',
            url: 'remove_review.php', 
            data: { reviewId: reviewId },
            success: function (response) {
                console.log('Reseña eliminada con éxito');
                
            },
            error: function (error) {
                console.error('Error al eliminar la reseña', error);
            }
        });
    });
});
