<?php 
/***
 * 
 * 
 * featres code here
 */
get_header();

?>

<section id ="featur-sec" class="feature-sec">
    
    
    <div class="slideshow-container">
        <!-- Slide 1 -->
        <div class="slide active">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/featur_section/Resin.jpg" alt="First Image">
            <div class="slide-content">
                <h2 class="slide-title">First Image Title</h2>
                <p class="slide-description">This is the description for the first image. It appears smoothly with the image.</p>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="slide">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/featur_section/painting.jpg" alt="Second Image">
            <div class="slide-content">
                <h2 class="slide-title">Second Image Title</h2>
                <p class="slide-description">Description for the second image. The text slides up when this image appears.</p>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="slide">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/featur_section/gift.webp" alt="Third Image">
            <div class="slide-content">
                <h2 class="slide-title">Third Image Title</h2>
                <p class="slide-description">Final image description. The text animation is synchronized with the image transition.</p>
            </div>
        </div>
    </div>

    


</section>

