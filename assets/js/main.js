jQuery(document).ready(function($) {
    const $images = $('.hero-images img');
    const $gradientOverlays = $('.gradient-overlay');
    let currentIndex = 0;
    const transitionTime = 1000; // 1s for animations
    const displayTime = 4000; // 4s display time
    
    // Initialize - show first image and gradient
    // $gradientOverlays.eq(0).addClass('active');
    // $images.not('.active').css({
    //     'transform': 'translateX(-100%) translateY(20%) rotateZ(10deg)',
    //     'z-index': 0
    // });

    function slideImages() {
        const nextIndex = (currentIndex + 1) % $images.length; // This % ensures it loops back to 0 after reaching the end
        const $currentImg = $images.eq(currentIndex);
        const $nextImg = $images.eq(nextIndex);
        const $currentGradient = $gradientOverlays.eq(currentIndex);
        const $nextGradient = $gradientOverlays.eq(nextIndex);
        
        // Only continue if we're not completing the cycle
        if (currentIndex === $images.length - 1) {
            // Final transition back to first image
            $currentImg.css({
                'transform': 'translateX(-150%) translateY(-20%) rotateZ(-10deg)',
                'z-index': 0,
                'transition': `transform ${transitionTime/1000}s cubic-bezier(0.5, 0, 0.1, 1)`
            });
            
            $nextImg.css({
                'transform': 'translateX(0) translateY(0) rotateZ(0)',
                'z-index': 3,
                'transition': `transform ${transitionTime/1000}s cubic-bezier(0.5, 0, 0.1, 1)`
            }).addClass('active');
            
            // Gradient transition
            $currentGradient.removeClass('active');
            $nextGradient.addClass('active');
            
            $currentImg.removeClass('active');
            return; // Stop the animation cycle
        }
        
        // Prepare next image
        // $nextImg.css({
        //     'transform': 'translateX(-100%) translateY(20%) rotateZ(10deg)',
        //     'z-index': 2
        // });
        
        // Animate out current image
        $currentImg.css({
            'transform': 'translateX(-150%) translateY(-20%) rotateZ(-10deg)',
            'z-index': 1,
            'transition': `transform ${transitionTime/1000}s cubic-bezier(0.5, 0, 0.1, 1)`
        });
        
        // Animate in next image
        $nextImg.css({
            'transform': 'translateX(0) translateY(0) rotateZ(0)',
            'z-index': 3,
            'transition': `transform ${transitionTime/1000}s cubic-bezier(0.5, 0, 0.1, 1)`
        }).addClass('active');
        
        // Gradient transition
        $currentGradient.removeClass('active');
        $nextGradient.addClass('active');
        
        $currentImg.removeClass('active');
        currentIndex = nextIndex;
        
        // Continue only if not reaching the last image
        if (!(currentIndex === $images.length - 1 && nextIndex === 0)) {
            setTimeout(slideImages, displayTime);
        }
    }
    
    // Start the cycle after initial display time
    setTimeout(slideImages, displayTime);
});