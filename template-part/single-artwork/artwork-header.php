    
    
    <!-- artwork single header -->
    <div class="single-artwork-header">

        <?php if (has_post_thumbnail()) : ?>

            <div class="artwork-thumpnail">
                <span class="imge-holder">
                    <?php the_post_thumbnail('large'); ?>
                    <h1 class="single-artwork-title"><?php the_title(); ?></h1>  

                </span>
            </div>

        <?php endif; ?>

        <span class="single-art-meta">
            <!-- add single artwork meta -->
            <?php 
                $ratio = get_post_meta(get_the_ID(), '_artwork_ratio', true);
                $colors = get_post_meta(get_the_ID(), '_artwork_colors', true);
                $exetime = get_post_meta(get_the_ID(), '_artwork_exetime', true); // execution time for project
                $price = get_post_meta(get_the_ID(), '_price', true);
                $color_array = explode(',', $colors);
                $types = get_the_terms(get_the_ID(), 'artwork_type');

            ?>
            
                <?php if ($ratio) : ?>
                    <p><strong>القياس:</strong> <?php echo esc_html($ratio); ?></p>
                <?php endif; ?>

                
                <?php if ($colors) : ?>
                    <p><strong>الألوان المستخدمة:</strong>
                <?php foreach ($color_array as $color) : ?>
                  <?php  $color = trim($color); ?>
                    <span class="colorplate" style="background-color: <?php echo esc_attr($color); ?>"></span>

                <?php endforeach; ?>  
                <?php else : ?>
                <span class="non-color-chip">لا يوجد</span>
                
                </p>


                <?php endif; ?>


                <?php if ($exetime) : ?>
                    <p><strong>وقت التنفيذ:</strong> <?php echo esc_html($exetime); ?></p>
                <?php endif; ?>


                <?php if ($price) : ?>
                    <p><strong>السعر:</strong> <?php echo esc_html($price); ?></p>
                <?php endif; ?>

                <?php if($types) : ?>
                <p><strong>التصنيف:</strong> 
                    <?php echo join(', ', wp_list_pluck($types, 'name')); ?>
                </p>
                <?php endif; ?>
                


                    <div class="artwork-rating-continer" data-post-id="<?php echo get_the_ID(); ?>">

                        <?php     
                        $rating_data = get_artwork_rating(get_the_ID());
                        echo '<p>' . "التقييم:" . "</p>";
                        echo do_shortcode('[artwork_rating]'); 
                        // echo "Average: " . round($rating_data['average'], 1) . "/5 (" . $rating_data['count'] . " votes)";
                        ?>
                        <input type="hidden" id="rating_nonce" name="rating_nonce" value="<?php echo wp_create_nonce('rating_nonce'); ?>">
                    </div> 

        </span>


    </div>