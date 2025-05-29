
jQuery(document).ready(function($) {
    // Uploading files
    var artwork_gallery_frame;
    var $image_gallery_ids = $('#artwork_gallery_images');
    var $artwork_gallery_images = $('.artwork-gallery-images');
    
    $('.add-artwork-gallery-images').on('click', 'a', function(e) {
        e.preventDefault();
        
        // If the media frame already exists, reopen it.
        if (artwork_gallery_frame) {
            artwork_gallery_frame.open();
            return;
        }

        
        // Create the media frame window.
        artwork_gallery_frame = wp.media.frames.artwork_gallery = wp.media({
            title: 'إضافة صور للمعرض',
            button: {
                text: 'أضافة الصور'
            },
            multiple: true //The multiple: "true" parameter is what makes it a gallery selector rather than a single image selector
        });

        
        // When an image is selected, run a callback.
        artwork_gallery_frame.on('select', function() {

            // Retrieves all selected images 
            var selection = artwork_gallery_frame.state().get('selection'); 

            //$image_gallery_ids.val() - Gets the current saved image IDs (stored in a hidden input field)
            var attachment_ids = $image_gallery_ids.val();

            //If there are IDs (like "45,78,92"), splits them into an array ["45", "78", "92"]
            attachment_ids = attachment_ids ? attachment_ids.split(',') : [];
            
            // loop through selection wiche means selected images 
            selection.map(function(attachment) {
                // turn images to json file so we can store data like image id, url, size etc..
                attachment = attachment.toJSON();
                if (attachment.id) {
                    // add id of image to attachment_ids
                    attachment_ids.push(attachment.id);
                    $artwork_gallery_images.append(
                        '<li data-attachment-id="' + attachment.id + '">\
                            <img src="' + attachment.sizes.thumbnail.url + '" />\
                            <a href="#" class="delete-artwork-image" title="<?php _e("Remove image", "textdomain"); ?>">×</a>\
                        </li>'
                    );
                }
            });
            // update attachment_ids with new ids
            $image_gallery_ids.val(attachment_ids.join(','));
        });
        
        // Finally, open the modal.
        artwork_gallery_frame.open();
    });
    
    // Remove images
    $artwork_gallery_images.on('click', '.delete-artwork-image', function(e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        var attachment_ids = $image_gallery_ids.val();
        attachment_ids = attachment_ids ? attachment_ids.split(',') : [];
        var id_to_remove = $li.data('attachment-id');
        
        attachment_ids = attachment_ids.filter(function(id) {
            return id != id_to_remove;
        });
        
        $image_gallery_ids.val(attachment_ids.join(','));
        $li.remove();
    });
    
    // Sortable
    // $artwork_gallery_images.sortable({
    //     items: 'li',
    //     cursor: 'move',
    //     scrollSensitivity: 40,
    //     forcePlaceholderSize: true,
    //     helper: 'clone',
    //     opacity: 0.65,
    //     placeholder: 'wc-metabox-sortable-placeholder',
    //     start: function(event, ui) {
    //         ui.item.css('background-color', '#f6f6f6');
    //     },
    //     stop: function(event, ui) {
    //         ui.item.removeAttr('style');
    //     },
    //     update: function() {
    //         var attachment_ids = [];
            
    //         $artwork_gallery_images.find('li').each(function() {
    //             var attachment_id = $(this).data('attachment-id');
    //             attachment_ids.push(attachment_id);
    //         });
            
    //         $image_gallery_ids.val(attachment_ids.join(','));
    //     }
    // });
});
