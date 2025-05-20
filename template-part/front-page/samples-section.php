<?php 
/***
 * 
 *  samples part code here
 * 
 */
?>

<section class="art-hero-section">
    <div class="gallary-continer">
        <!-- Background image -->
        <div class="art-hero-background">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero/Resin.jpg" alt="فن الريزن">
            <div class="art-hero-overlay"></div>
        </div>
        
        <!-- Content container -->
        <div class="art-hero-content">
            <div class="art-content-inner">
                <h2 class="art-title">
                    <span class="title-underline">أعمالنا الإبداعية</span>
                </h2>
                
                <p class="art-description">
                    ساعات ريزن فنية تتحول مع الوقت إلى تحف تخطف الأنظار. كل قطعة تحكي قصة تفاعل الألوان والضوء.
                </p>
                
                <div class="art-features">
                    <div class="feature">
                        <span class="feature-icon">⏳</span>
                        <span>تصاميم فريدة تدوم طويلاً</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon">🎨</span>
                        <span>ألوان متحركة تنبض بالحياة</span>
                    </div>
                </div>
                
                <a href="<?php echo esc_url(home_url('/gallary')); ?>" class="art-button">
                    استكشف المعرض
                    <span class="button-arrow">←</span>
                </a>
            </div>
        </div>
    </div>
</section>


