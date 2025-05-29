<?php 
get_header(); ?>


<section class="art-taxonomy-body">
    
    <div class="art-taxonomy-header">
        <span class="txt-img-taxonomy">
            <h2><?php single_cat_title(); ?></h2>
        </span>
    </div>

    <div class="slider-body-taxonomy">
        <div class="artwork-slider-continer">
            <?php while (have_posts()) : the_post(); 
                $ratio = get_post_meta(get_the_ID(), '_artwork_ratio', true);
                $colors = get_post_meta(get_the_ID(), '_artwork_colors', true);
                $color_array = explode(',', $colors);
            ?>
                <div class="artwork-slide-box">
                    <a href="<?php the_permalink(); ?>" class="artwork-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="artwork-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                                <div class="artwork-overlay">
                                    <h3 class="artwork-title"><?php the_title(); ?></h3>
                                    <?php if ($ratio) : ?>
                                        <span class="artwork-meta ratio"><i class="fas fa-ruler-combined"></i> <?php echo esc_html($ratio); ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if ($colors) : ?>
                                        <div class="color-palette">
                                            <?php foreach ($color_array as $color) : 
                                                $color = trim($color); ?>
                                                <span class="color-chip" style="background-color: <?php echo esc_attr($color); ?>"></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="slider-controls">
            <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

</section>

<?php get_footer(); ?>