<?php 
/***
 * 
 * FRONT PAGE TEMPLATE
 * 
 * 
 */
get_header();
?>
<section id="main-page" class="main-page">
    

    
    <div id="main-front" class="front-hero">

        <div class="hero-container">

            <!-- three hiden layers (except active class) fot gradient layers -->
            <div class="gradient-overlay gradient-1 active"></div>
            <div class="gradient-overlay gradient-2"></div>
            <div class="gradient-overlay gradient-3"></div>
            <div class="gradient-overlay gradient-1"></div>

            <div class="hero-text">
                <span class="hero-bold-text">
                    أدخل إلى عالم
                    من الفن والإبداع
                    مع استديو أرتوبيا     
                </span>

                <span class="hero-light-text">
                                    حول محيطك إلى فضاء من الفن والجمال
                                    عبر لوحات الريزن الفنية

                </span>
            </div>
            <div class="hero-images">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/1.png " class="active" style="z-index: 4"> <!-- Index 3 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/2.png " style="z-index: 3"> <!-- Index 0 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/3.png " style="z-index: 2"> <!-- Index 1 -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero/1.png " style="z-index: 1"> <!-- Index 2 -->
            </div>

        </div>
    </div>
</section>