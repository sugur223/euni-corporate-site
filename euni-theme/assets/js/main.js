/**
 * Euni Theme Main JavaScript
 *
 * @package Euni_Theme
 */

(function() {
    'use strict';

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

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without jumping
                    if (history.pushState) {
                        history.pushState(null, null, hash);
                    }
                }
            });
        });
    }

    /**
     * Header scroll effect
     */
    function initHeaderScroll() {
        const header = document.querySelector('.l-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            // Add shadow on scroll
            if (currentScroll > 10) {
                header.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
            }

            lastScroll = currentScroll;
        });
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

        window.addEventListener('scroll', function() {
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
        });
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

        if (!menuToggle || !gnav) return;

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const isActive = gnav.classList.contains('-active');

            if (isActive) {
                // Close menu
                gnav.classList.remove('-active');
                menuToggle.classList.remove('-active');
                body.classList.remove('menu-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
            } else {
                // Open menu
                gnav.classList.add('-active');
                menuToggle.classList.add('-active');
                body.classList.add('menu-open');
                menuToggle.setAttribute('aria-expanded', 'true');
                menuToggle.setAttribute('aria-label', 'メニューを閉じる');
            }
        });

        // Close menu when clicking on a menu item
        const menuLinks = gnav.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                gnav.classList.remove('-active');
                menuToggle.classList.remove('-active');
                body.classList.remove('menu-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!gnav.contains(e.target) && !menuToggle.contains(e.target)) {
                if (gnav.classList.contains('-active')) {
                    gnav.classList.remove('-active');
                    menuToggle.classList.remove('-active');
                    body.classList.remove('menu-open');
                    menuToggle.setAttribute('aria-expanded', 'false');
                    menuToggle.setAttribute('aria-label', 'メニューを開く');
                }
            }
        });

        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && gnav.classList.contains('-active')) {
                gnav.classList.remove('-active');
                menuToggle.classList.remove('-active');
                body.classList.remove('menu-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
            }
        });

        // Close menu on window resize if > 768px
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && gnav.classList.contains('-active')) {
                gnav.classList.remove('-active');
                menuToggle.classList.remove('-active');
                body.classList.remove('menu-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'メニューを開く');
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
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                button.style.opacity = '1';
                button.style.visibility = 'visible';
            } else {
                button.style.opacity = '0';
                button.style.visibility = 'hidden';
            }
        });

        // Scroll to top on click
        button.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
     * Initialize all functions when DOM is ready
     */
    function init() {
        initSmoothScroll();
        initHeaderScroll();
        initScrollAnimations();
        initActiveNavigation();
        initExternalLinks();
        initFormValidation();
        initMobileMenu();
        initBackToTop();
    }

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
