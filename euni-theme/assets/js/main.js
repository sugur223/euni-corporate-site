/**
 * Euni Theme Main JavaScript
 *
 * @package Euni_Theme
 */

(function() {
    'use strict';

    /**
     * Prevent scroll position restoration on page load
     */
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    /**
     * Force scroll to top on page load
     */
    window.addEventListener('beforeunload', function() {
        window.scrollTo(0, 0);
    });

    // Immediate scroll to top on load
    window.scrollTo(0, 0);

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        // Select all links (both relative #hash and full URL with hash)
        const links = document.querySelectorAll('a[href*="#"]');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Extract hash from URL
                let hash = '';
                if (href.includes('#')) {
                    hash = href.substring(href.indexOf('#'));
                }

                // Skip if no hash or hash is just "#"
                if (!hash || hash === '#') {
                    return;
                }

                // Check if this is a same-page link
                const linkURL = new URL(href, window.location.href);
                const currentURL = window.location;

                // Only handle same-page links
                if (linkURL.pathname !== currentURL.pathname && linkURL.pathname !== '/') {
                    return;
                }

                const target = document.querySelector(hash);

                if (target) {
                    e.preventDefault();

                    const header = document.querySelector('.l-header');
                    const headerHeight = header ? header.offsetHeight : 80;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 30;

                    // Smooth scroll implementation
                    const startPosition = window.pageYOffset;
                    const distance = targetPosition - startPosition;
                    const duration = 800;
                    let start = null;

                    function smoothScroll(timestamp) {
                        if (!start) start = timestamp;
                        const progress = timestamp - start;
                        const percentage = Math.min(progress / duration, 1);
                        const easing = easeInOutCubic(percentage);

                        window.scrollTo(0, startPosition + distance * easing);

                        if (progress < duration) {
                            window.requestAnimationFrame(smoothScroll);
                        } else {
                            // Update URL after scroll completes
                            if (history.pushState) {
                                history.pushState(null, null, hash);
                            }
                        }
                    }

                    function easeInOutCubic(t) {
                        return t < 0.5
                            ? 4 * t * t * t
                            : 1 - Math.pow(-2 * t + 2, 3) / 2;
                    }

                    window.requestAnimationFrame(smoothScroll);
                }
            });
        });
    }

    /**
     * Header scroll effect - Disabled to prevent jitter
     */
    function initHeaderScroll() {
        // Disabled for better performance and to prevent jitter on mobile
        // Header shadow is now static via CSS
        return;
    }

    /**
     * Animate elements on scroll
     */
    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements with animation class
        const animatedElements = document.querySelectorAll('.c-card, .c-valueCard, .c-boxCard, .news-item');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }

    /**
     * Add active class to nav menu items based on scroll position
     */
    function initActiveNavigation() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.c-gnav a[href*="#"]');

        if (sections.length === 0 || navLinks.length === 0) return;

        let ticking = false;

        function updateActiveNav() {
            let current = '';
            const scrollPosition = window.pageYOffset;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                let hash = '';

                if (href && href.includes('#')) {
                    hash = href.substring(href.indexOf('#'));
                }

                link.parentElement.classList.remove('current-menu-item');
                if (hash === '#' + current) {
                    link.parentElement.classList.add('current-menu-item');
                }
            });

            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateActiveNav);
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * Handle external links
     */
    function initExternalLinks() {
        const links = document.querySelectorAll('a[href^="http"]');

        links.forEach(link => {
            const linkHost = new URL(link.href).hostname;
            const siteHost = window.location.hostname;

            if (linkHost !== siteHost) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    }

    /**
     * Form validation (if Contact Form 7 is not used)
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('.contact-form form');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const email = form.querySelector('input[type="email"]');
                const message = form.querySelector('textarea');

                let isValid = true;

                if (email && !email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                    isValid = false;
                    showError(email, 'Please enter a valid email address');
                }

                if (message && message.value.trim().length < 10) {
                    isValid = false;
                    showError(message, 'Please enter a message (at least 10 characters)');
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    }

    /**
     * Show form error
     */
    function showError(input, message) {
        // Remove existing error
        const existingError = input.parentElement.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        // Add error message
        const error = document.createElement('div');
        error.className = 'error-message';
        error.style.color = '#ef4444';
        error.style.fontSize = '0.875rem';
        error.style.marginTop = '0.25rem';
        error.textContent = message;

        input.style.borderColor = '#ef4444';
        input.parentElement.appendChild(error);

        // Remove error on input
        input.addEventListener('input', function() {
            input.style.borderColor = '';
            if (error.parentElement) {
                error.remove();
            }
        }, { once: true });
    }

    /**
     * Mobile hamburger menu
     */
    function initMobileMenu() {
        const menuToggle = document.getElementById('menuToggle');
        const gnav = document.getElementById('gnav');
        const body = document.body;
        const menuToggleLabel = menuToggle ? menuToggle.querySelector('.l-header__toggle-label') : null;

        if (!menuToggle || !gnav) return;

        function setMenuState(isOpen) {
            if (isOpen) {
                gnav.classList.add('-active');
                menuToggle.classList.add('-active');
                body.classList.add('menu-open');
                menuToggle.setAttribute('aria-expanded', 'true');
                menuToggle.setAttribute('aria-label', 'メニューを閉じる');
                if (menuToggleLabel) menuToggleLabel.textContent = 'close';

                // Re-trigger menu item animations
                const menuItems = gnav.querySelectorAll('.menu-item');
                menuItems.forEach((item, index) => {
                    item.style.animation = 'none';
                    setTimeout(() => {
                        item.style.animation = '';
                    }, 10);
                });
            } else {
                gnav.classList.remove('-active');
                menuToggle.classList.remove('-active');
                body.classList.remove('menu-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
                if (menuToggleLabel) menuToggleLabel.textContent = 'menu';
            }
        }

        // Toggle menu function
        function toggleMenu(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            const isActive = gnav.classList.contains('-active');

            setMenuState(!isActive);
        }

        // Add both click and touchstart listeners for better mobile support
        menuToggle.addEventListener('click', toggleMenu);
        menuToggle.addEventListener('touchstart', function(e) {
            toggleMenu(e);
        }, { passive: false });

        // Close menu when clicking on a menu item
        const menuLinks = gnav.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Allow the link to work, then close menu after a short delay
                setTimeout(function() {
                    setMenuState(false);
                }, 100);
            });
        });

        // Close menu when clicking on overlay
        function closeMenuOnOutsideClick(e) {
            // Check if menu is open and click is outside menu and toggle button
            if (gnav.classList.contains('-active')) {
                const isClickInsideMenu = gnav.contains(e.target);
                const isClickOnToggle = menuToggle.contains(e.target);
                const isClickOnLink = e.target.tagName === 'A' || e.target.closest('a');

                // Don't close if clicking on a link (let the link handler do it)
                if (!isClickInsideMenu && !isClickOnToggle && !isClickOnLink) {
                    setMenuState(false);
                }
            }
        }

        document.addEventListener('click', closeMenuOnOutsideClick);
        document.addEventListener('touchend', closeMenuOnOutsideClick, { passive: true });

        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && gnav.classList.contains('-active')) {
                setMenuState(false);
            }
        });

        // Close menu on window resize if > 768px
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && gnav.classList.contains('-active')) {
                setMenuState(false);
            }
        });
    }

    /**
     * Back to top button
     */
    function initBackToTop() {
        // Create button
        const button = document.createElement('button');
        button.className = 'back-to-top';
        button.innerHTML = '↑';
        button.setAttribute('aria-label', 'Back to top');

        // Style button
        Object.assign(button.style, {
            position: 'fixed',
            bottom: '2rem',
            right: '2rem',
            width: '50px',
            height: '50px',
            borderRadius: '50%',
            backgroundColor: '#2563eb',
            color: '#ffffff',
            border: 'none',
            fontSize: '1.5rem',
            cursor: 'pointer',
            opacity: '0',
            visibility: 'hidden',
            transition: 'all 0.3s ease',
            zIndex: '999',
            boxShadow: '0 4px 12px rgba(37, 99, 235, 0.3)'
        });

        document.body.appendChild(button);

        // Show/hide on scroll
        let ticking = false;
        function updateButtonVisibility() {
            if (window.pageYOffset > 300) {
                button.style.opacity = '1';
                button.style.visibility = 'visible';
            } else {
                button.style.opacity = '0';
                button.style.visibility = 'hidden';
            }
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateButtonVisibility);
                ticking = true;
            }
        }, { passive: true });

        // Scroll to top on click
        button.addEventListener('click', function() {
            const startPosition = window.pageYOffset;
            const duration = 600;
            let start = null;

            function smoothScrollToTop(timestamp) {
                if (!start) start = timestamp;
                const progress = timestamp - start;
                const percentage = Math.min(progress / duration, 1);
                const easing = 1 - Math.pow(1 - percentage, 3);

                window.scrollTo(0, startPosition * (1 - easing));

                if (progress < duration) {
                    window.requestAnimationFrame(smoothScrollToTop);
                }
            }

            window.requestAnimationFrame(smoothScrollToTop);
        });

        // Hover effect
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 6px 16px rgba(37, 99, 235, 0.4)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 12px rgba(37, 99, 235, 0.3)';
        });
    }

    /**
     * Parallax effect for Purpose section
     */
    function initParallaxEffect() {
        const parallaxTriggers = document.querySelectorAll('.js-parallax-trigger');

        if (parallaxTriggers.length === 0) return;

        let ticking = false;

        function updateParallax() {
            parallaxTriggers.forEach(trigger => {
                const rect = trigger.getBoundingClientRect();
                const scrolled = window.pageYOffset;

                // Only apply parallax if element is in viewport
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const parallaxElements = trigger.querySelectorAll('.js-parallax');
                    const parallaxElements2 = trigger.querySelectorAll('.js-parallax2');

                    parallaxElements.forEach(el => {
                        const speed = 0.05;
                        const yPos = -(scrolled * speed);
                        el.style.transform = `translate3d(0, ${yPos}%, 0)`;
                    });

                    parallaxElements2.forEach(el => {
                        const speed = 0.03;
                        const yPos = -(scrolled * speed);
                        el.style.transform = `translate3d(0, ${yPos}%, 0)`;
                    });
                }
            });

            ticking = false;
        }

        // Use requestAnimationFrame for better performance
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });

        // Initial call
        updateParallax();
    }

    /**
     * Initialize all functions when DOM is ready
     */
    function init() {
        // Ensure scroll is at top on init
        window.scrollTo(0, 0);

        initSmoothScroll();
        initHeaderScroll();
        initScrollAnimations();
        initActiveNavigation();
        initExternalLinks();
        initFormValidation();
        initMobileMenu();
        initBackToTop();
        initParallaxEffect();
    }

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
