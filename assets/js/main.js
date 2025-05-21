jQuery(document).ready(function($) {
    const $images = $('.hero-images img');
    const $gradientOverlays = $('.gradient-overlay');
    let currentIndex = 0;
    const transitionTime = 1000; // 1s for animations
    const displayTime = 4000; // 4s display time
    const $slides = $('.slide');
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds
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



    // =============================================
    // SHRINK HEADER FUNCTIONALITY
    // =============================================

    var $header = $('.site-header');
    var $navMenu = $('.arttopia-header');
    var $navUl = $('.nav-ul');
    var $imgLogo =$('.arttopia-logo');
    var $callUsButton = $('.call-us-list');
    var scrollThreshold = 150;
    var lastScroll = 50;
    var ticking = false;

    // this function add,remove (.shrink) class from siteheader etc..
    function addRemoveShrink() {

        var currentScroll = $(window).scrollTop();
        var isMobile = window.matchMedia('(max-width: 768px)').matches;

        // added isMobaile so there is no shrink on mibile screen :)
        if(currentScroll > scrollThreshold && !isMobile) {

            $header.addClass('shrink');
            $navMenu.addClass('shrink');
            $navUl.addClass('shrink');
            $imgLogo.addClass('shrink');
            $callUsButton.addClass('blue-button');
        } else {
            $header.removeClass('shrink');
            $navMenu.removeClass('shrink');
            $navUl.removeClass('shrink');
            $imgLogo.removeClass('shrink');
            $callUsButton.removeClass('blue-button');            
        }
        ticking = false;
    }

    // applay changes with if condiation
    $(window).on('scroll',function() {
        lastScroll = $(window).scrollTop();
        if(!ticking) {
            window.requestAnimationFrame(addRemoveShrink);
            ticking = true;
        }
    });



    //=====================================//
    //====== NAVIGATION MENU JavaScript====//
    //=====================================//

    // Elements
    const toggleButton = document.querySelector('.mobile-menu-toggle');
    const navUl = document.querySelector('.nav-ul');
    const menuLinks = document.querySelectorAll('.nav-ul a');


    // Separate functions for clarity
    function openMenu() {
        toggleButton.setAttribute('aria-expanded', 'true');
        navUl.setAttribute('data-visible', 'true');
    }

    function closeMenu() {
        toggleButton.setAttribute('aria-expanded', 'false');
        navUl.setAttribute('data-visible', 'false');
    }

    // Initialize
    toggleButton.addEventListener('click', toggleMenu);

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        const isClickInsideMenu = navUl.contains(e.target);
        const isClickOnToggle = e.target === toggleButton || toggleButton.contains(e.target);
        
        if (!isClickInsideMenu && !isClickOnToggle && navUl.getAttribute('data-visible') === 'true') {
            closeMenu();
        }
    });

    // Close when clicking links (optional)
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Toggle function
    function toggleMenu() {
        const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            closeMenu();
        } else {
            openMenu();
        }
    }
    function nextSlide() {
        $slides.removeClass('active').eq(currentSlide).removeClass('active');
        currentSlide = (currentSlide + 1) % $slides.length;
        $slides.eq(currentSlide).addClass('active');
    }
    
    // Start slideshow
    setInterval(nextSlide, slideInterval);
    
    
});