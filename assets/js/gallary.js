jQuery(document).ready(function($) {
    // Cache elements
    const $slider = $('.artwork-slider-continer');
    const $slides = $('.artwork-slide-box');
    const $prevBtn = $('.slider-prev');
    const $nextBtn = $('.slider-next');
    
    // Initialize - set first slide as centered
    $slides.removeClass('center-slide');
    
    if(window.innerWidth > 768) {
    $slides.eq(0).addClass('center-slide');
    } else {
        $slides.addClass('center-slide');
    }

    // Navigation functions
    function moveToSlide(index) {
        // Remove center class from all slides
        $slides.removeClass('center-slide');
        
        // Handle wrap-around for infinite feel
        if (index >= $slides.length) index = 0;
        if (index < 0) index = $slides.length - 1;
        
        // Add center class to new slide
        $slides.eq(index).addClass('center-slide');
        
        // Scroll to center the slide
        const $currentSlide = $slides.eq(index);
        const sliderCenter = $slider.width() / 2;
        const slidePosition = $currentSlide.position().left + ($currentSlide.width() / 2);
        const scrollPosition = $slider.scrollLeft() + (slidePosition - sliderCenter);
        
        $slider.animate({
            scrollLeft: scrollPosition
        }, 300);
    }
    
    // Button click handlers
    $nextBtn.on('click', function() {
        const currentIndex = $slides.filter('.center-slide').index();
        moveToSlide(currentIndex + 1);
    });
    
    $prevBtn.on('click', function() {
        const currentIndex = $slides.filter('.center-slide').index();
        moveToSlide(currentIndex - 1);
    });
    
    // Hide buttons on mobile
    function handleMobileView() {
        if (window.innerWidth < 768) {
            $prevBtn.hide();
            $nextBtn.hide();
        } else {
            $prevBtn.show();
            $nextBtn.show();
        }
    }
    
    // Initialize mobile view
    handleMobileView();
    $(window).on('resize', handleMobileView);
});