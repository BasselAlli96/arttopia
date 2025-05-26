<?php get_header(); ?>

<section id="main-gallery" class="main-gallery-body">
    <div class="gallery-header">
        <span>
            <h1><?php single_cat_title(); ?></h1>
        </span>
    </div>

    <div class="gallery-continer">
        <?php
        // Set up pagination
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $current_term = get_queried_object();
        
        // Query arguments
        $gallery_query =  new WP_Query(array(
            'post_type' => 'artwork',
            'tax_query' => array(
                array(
                    'taxonomy' => $current_term->taxonomy,
                    'field' => 'slug',
                    'terms' => $current_term->slug,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                )),
            'posts_per_page' => 3,
            'paged' => $paged
        ));
        
        
        if ($gallery_query->have_posts()) :
            while ($gallery_query->have_posts()) : $gallery_query->the_post();
                $ratio = get_post_meta(get_the_ID(), '_artwork_ratio', true);
                $colors = get_post_meta(get_the_ID(), '_artwork_colors', true);
                $color_array = explode(',', $colors);
        ?>

        <div class="gallery-card">
            <?php if (has_post_thumbnail()) : ?>
                <div class="card-thumbnail">
                    <a class="image-click" href="<?php the_permalink(); ?>" target="_blank">
                        <?php the_post_thumbnail('large'); ?>
                    </a>

                    <span class="post-meta-detiles">
                        <span class="color-chip-continer">
                           ألوان المشروع:
                            <?php if ($colors) : ?>
                                <?php foreach ($color_array as $color) : 
                                    $color = trim($color); ?>
                                    <span class="color-chip" style="background-color: <?php echo esc_attr($color); ?>"></span>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="non-color-chip">لا يوجد</span>
                            <?php endif; ?>
                        </span>

                        <span class="artwork-ratio-continer">
                            الأبعاد:
                            <?php if ($ratio) : ?>
                                <span class="artwork-ratio"><i class="fas fa-ruler-combined"></i> <?php echo esc_html($ratio); ?></span>
                            <?php else : ?>
                                <span class="non-artwork-ratio"> لا يوجد</span>
                            <?php endif; ?>
                        </span> 


                    </span>
                    <span class="post-date">
                        <?php echo get_the_date(); ?>
                    </span>

                </div>
            <?php endif; ?>

            <div class="card-solid-box">
                <div class="artwork-overlay">
                    <h3 class="artwork-title"><?php the_title(); ?></h3>


                    
                    <span class="artwork-button"><a href="<?php the_permalink(); ?>" target="_blank">عرض</a></span>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <!-- Correct Pagination -->
    <div class="gallery-pagination">
        <?php
        $total_pages = $gallery_query->max_num_pages;
        
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));
            
            echo paginate_links(array(
                'base' => get_term_link($current_term) . 'page/%#%/',
                'format' => '%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => __('« السابق'),
                'next_text' => __('التالي »'),
                'mid_size' => 2,
                'type' => 'list',
                'add_args' => false
            ));
        }
        ?>
         
        <?php else :?>

        <h3> لا يوجد منشورات</h3>

        <?php endif; ?>

        <?php wp_reset_postdata();?>

    </div>

</section>

<?php get_footer(); ?>