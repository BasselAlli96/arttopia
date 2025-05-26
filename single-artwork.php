<?php
/***
 * 
 * 
 * 
 */
get_header(); ?>


<?php require_once('wp-load.php'); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php get_the_category('name') ?>>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        
        <div class="entry-content">
            <?php the_content(); ?>
            
            <div class="artwork-meta">
                <h3><?php _e('تفاصيل العمل', 'arttopia'); ?></h3>
                
                <?php 
                // Display taxonomy terms (work types)
                $types = get_the_terms(get_the_ID(), 'artwork_type');
                if ($types && !is_wp_error($types)) : ?>
                    <p><strong><?php _e('نوع العمل:', 'arttopia'); ?></strong> 
                        <?php echo join(', ', wp_list_pluck($types, 'name')); ?>
                    </p>

                <?php endif; ?>
                
                <?php 
                // Display custom meta
                $ratio = get_post_meta(get_the_ID(), '_artwork_ratio', true);
                $colors = get_post_meta(get_the_ID(), '_artwork_colors', true);
                
                if ($ratio) : ?>
                    <p><strong><?php _e('نسبة الألوان:', 'arttopia'); ?></strong> <?php echo esc_html($ratio); ?></p>
                <?php endif;
                
                if ($colors) : ?>
                    <p><strong><?php _e('الألوان المستخدمة:', 'arttopia'); ?></strong> <?php echo esc_html($colors); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>