<?php
/**
 * Template Name: Gallery Page
 * Description: Displays the art gallery
 */
get_header(); ?>

<?php
// Define your image paths (relative to theme)
$images_rel_path = array(
    // key is taxonomy term slug, value is relative path to image
    'clocks'   => '/assets/images/gallery-images/clocks.png',
    'risen-arts' => '/assets/images/gallery-images/risen-arts.png',
    'paint-arts' => '/assets/images/gallery-images/paint-arts.png',
    'gifts'      => '/assets/images/gallery-images/gifts.png',
    'personal-paint' => '/assets/images/gallery-images/gifts.png'
);
?>


<section id="main-gallary" class="gallary-section">

    <div class="intro-gal-cont">

        <div class="intro-gal-txt">
            <h1>معرض يوتوبيا</h1>
            <p>أهلا بك إلى معرض يوتوبيا
                عالم كبير من االاعمال الفنية
            </p>

        </div> 

    </div>

    <div class="gallery-container">

        <span class="gallery-txt-title">
            <h2>أختر التصنيف</h2>
        </span>

        <div class="gallery-item-continer">
        <?php 
        // Get all terms from your artwork_type taxonomy
        $categories = get_terms(array(
            'taxonomy' => 'artwork_type',
            'hide_empty' => false, // Show all terms even if empty
        ));

        if (!empty($categories) && !is_wp_error($categories)) :
            foreach ($categories as $category) :
                $term_url = get_term_link($category);
                // Check if current term slug exists in our image array
                if (array_key_exists($category->slug, $images_rel_path)) {
                    $full_image_url = get_template_directory_uri() . $images_rel_path[$category->slug];
                    ?>
                    <div class="category-item">


                        <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">

                        <h3><?php echo esc_html($category->name); ?></h3>

                        <p>
                            <?php echo esc_html($category->description); ?>
                        </p>

                        <span class="galley-button-continer">
                            <a target="_blank" href="<?php echo esc_url($term_url); ?>">
                                <p class="gallery-button">عرض الأعمال</p>
                            </a>
                        </span>

                    </div>
                    <?php
                            
                }

                
            endforeach;
        endif;
        ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>