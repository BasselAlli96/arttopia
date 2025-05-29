jQuery(document).ready(function($) {
    $('.artwork-rating input[type="radio"]').on('change', function() {
        var $ratingContainer = $(this).closest('.artwork-rating');
        var postId = $ratingContainer.data('post-id');
        var ratingValue = this.value;
        var nonce = $ratingContainer.find('#rating_nonce').val(); // Get nonce from hidden field

        console.log('Using nonce:', nonce); // Debug
        
        $.ajax({
            url: ajaxurl, // Make sure ajaxurl is defined or use artworkRatings.ajaxurl
            type: 'POST',
            data: {
                action: 'submit_artwork_rating',
                post_id: postId,
                rating: ratingValue,
                nonce: nonce
            },
            success: function(response) {
                if (response.success) {
                    // Update UI
                    $ratingContainer.find('.average').text(response.data.average);
                    $ratingContainer.find('.count').text(response.data.count);
                    
                    // Update nonce for next request
                    $ratingContainer.find('#rating_nonce').val(response.data.new_nonce);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
});