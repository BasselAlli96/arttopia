
<section id="main-slider-single" class="single-slider-body">

            <?php 

                $gallery_images = get_post_meta(get_the_ID(), '_artwork_gallery_images', true);
                $single_slider = !empty($gallery_images) ? explode(',', $gallery_images) : array();
                
                if (!empty($single_slider)) {
                    echo '<div class="artwork-slider-continer">';
                    foreach ($single_slider as $image_id) {
                        $image_url = wp_get_attachment_image_url($image_id, 'full');
                        if ($image_url) {
                            echo '<div class="artwork-slid-box"><img src="' . esc_url($image_url) . '" alt=""></div>';
                        }
                    }
                    echo '</div>';
                }
            ?>

        <div class="slider-controls">
            <button class="slider-prev">السابق</button>
            <button class="slider-next">التالي</button>
        </div>



</section>