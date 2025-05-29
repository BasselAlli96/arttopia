<?php
/***
 * 
 * 
 *
 */
get_header(); ?>

<section id="main-artwork-body" class="single-art-body"
<?php while (have_posts()) : the_post(); ?>

    <?php
    $single_artwork_section = load_theme_parts('single-artwork');

        foreach ($single_artwork_section as $sections) {
            get_template_part( 'template-part/single-artwork/' . $sections[ 'template' ]);
        }

    ?>
        
    <!-- artwork single body -->
    <!-- <article id="post-<?php the_ID(); ?>" <?php get_the_category('name') ?>>
        
        <div class="entry-content">
            <?php the_content(); ?>
            
            <div class="artwork-meta">
                <h3><?php _e('تفاصيل العمل', domain: 'arttopia'); ?></h3>
            </div>

        </div>
    </article> -->
<?php endwhile; ?>

<?php get_footer(); ?>