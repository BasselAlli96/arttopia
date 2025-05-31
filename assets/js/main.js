jQuery(document).ready(function($) {
    const $images = $('.hero-images img');
    const $gradientOverlays = $('.gradient-overlay');
    let currentIndex = 0;
    const transitionTime = 1000; // 1s for animations
    const displayTime = 4000; // 4s display time



    function slideImages() {
        const nextIndex = (currentIndex + 1); // This % ensures it loops back to 0 after reaching the end
        const $currentImg = $images.eq(currentIndex);
        const $nextImg = $images.eq(nextIndex);
        const $currentGradient = $gradientOverlays.eq(currentIndex);
        const $nextGradient = $gradientOverlays.eq(nextIndex);
                // Continue only if not reaching the last image
        if (!(currentIndex === $images.length - 2 && nextIndex === 3)) {
            setTimeout(slideImages, displayTime);
        }

        
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
    var scrollThreshold = 40;
    var lastScroll = 40;
    var ticking = false;

    // this function add,remove (.shrink) class from siteheader etc..
    function addRemoveShrink() {

        var currentScroll = $(window).scrollTop();
        // console.log(currentScroll)
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

    // Separated functions for clarity
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


    // ===================================================
    // ===========
    const $slides = $('.slide');
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds

    function nextSlide() {
        $slides.removeClass('active').eq(currentSlide).removeClass('active');
        currentSlide = (currentSlide + 1) % $slides.length;
        $slides.eq(currentSlide).addClass('active');
    }
    
    // Start slideshow
    setInterval(nextSlide, slideInterval);
    



    // ================================
    // =======Gallery fade out effect=======
    // ================================


    function animateGalleryItems() {
        const $items = $('.category-item');
        const observer = new IntersectionObserver
        (
            function(entries) {
                entries.forEach
                (
                    function(entry, index) {
                        if (entry.isIntersecting) {
                            setTimeout(function() {
                                $(entry.target).addClass('is-visible');
                            }, 500 * index);
                        }
                });
            }, {threshold: 0.1});

        $items.each(function() {
            observer.observe(this);
        });
    }

    animateGalleryItems();



});