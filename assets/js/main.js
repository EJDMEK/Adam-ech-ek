// Mobile menu toggle - Simple and robust
(function() {
    let isInitialized = false;
    
    function initMobileMenu() {
        // Prevent multiple initializations
        if (isInitialized) {
            return;
        }
        
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        console.log('Init mobile menu - toggle:', menuToggle, 'menu:', navMenu);
        
        if (!menuToggle || !navMenu) {
            console.error('Mobile menu elements not found!', { menuToggle, navMenu });
            return;
        }
        
        // Mark as initialized
        isInitialized = true;
        
        console.log('Mobile menu initialized successfully');
        
        // Toggle menu on button click - use direct onclick for reliability
        menuToggle.onclick = function(e) {
            console.log('Hamburger clicked!');
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            const wasActive = navMenu.classList.contains('active');
            console.log('Menu was active:', wasActive);
            
            if (wasActive) {
                navMenu.classList.remove('active');
                console.log('Menu closed');
            } else {
                navMenu.classList.add('active');
                console.log('Menu opened');
            }
        };
        
        // Also add event listener as backup
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            navMenu.classList.toggle('active');
        }, { passive: false });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (navMenu.classList.contains('active')) {
                if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                    navMenu.classList.remove('active');
                }
            }
        });
        
        // Close menu when clicking on menu links
        const menuLinks = navMenu.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }
    
    // Also try after window load as fallback
    window.addEventListener('load', function() {
        if (!isInitialized) {
            console.log('Trying to init mobile menu after window load');
            initMobileMenu();
        }
    });
})();

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.length > 1) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// Contact form handling
const contactForm = document.querySelector('.contact-form form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('.submit-button');
        const originalText = submitButton.textContent;
        
        // Disable button
        submitButton.disabled = true;
        submitButton.textContent = 'Odesílám...';
        
        fetch(this.action || window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Děkujeme! Vaše zpráva byla odeslána.');
                this.reset();
            } else {
                alert('Chyba: ' + (data.message || 'Nepodařilo se odeslat zprávu.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Chyba při odesílání formuláře. Zkuste to prosím znovu.');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        });
    });
}

// File upload preview (optional enhancement)
const fileInput = document.querySelector('input[type="file"]');
if (fileInput) {
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileSizeMB = file.size / (1024 * 1024);
            if (fileSizeMB > 10) {
                alert('Soubor je příliš velký. Maximální velikost je 10MB.');
                this.value = '';
            }
        }
    });
}

// Company Carousel
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.company-carousel');
    if (carousel) {
        // Duplicate logos for infinite scroll effect
        const originalLogos = carousel.innerHTML;
        carousel.innerHTML = originalLogos + originalLogos + originalLogos;
        
        // Touch support - allow manual scrolling on mobile
        let isScrolling = false;
        let scrollStart = 0;
        
        carousel.addEventListener('touchstart', function(e) {
            isScrolling = true;
            scrollStart = e.touches[0].clientX;
            carousel.style.animationPlayState = 'paused';
        });
        
        carousel.addEventListener('touchmove', function(e) {
            if (isScrolling) {
                const scrollCurrent = e.touches[0].clientX;
                const scrollDiff = scrollStart - scrollCurrent;
                carousel.style.transform = `translateX(${-scrollDiff}px)`;
            }
        });
        
        carousel.addEventListener('touchend', function() {
            if (isScrolling) {
                isScrolling = false;
                // Resume animation after a moment
                setTimeout(() => {
                    carousel.style.transform = '';
                    carousel.style.animationPlayState = 'running';
                }, 100);
            }
        });
    }
});

// Sticky header scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.main-header');
    if (header) {
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            if (currentScroll > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            lastScroll = currentScroll;
        });
    }
});

