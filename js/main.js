// Mobile Menu Toggle
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const toggleBtn = document.querySelector('.mobile-toggle');
    mobileMenu.classList.toggle('active');
    toggleBtn.classList.toggle('active');
    document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
}

function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const toggleBtn = document.querySelector('.mobile-toggle');
    mobileMenu.classList.remove('active');
    toggleBtn.classList.remove('active');
    document.body.style.overflow = '';
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const toggleBtn = document.querySelector('.mobile-toggle');
    if (mobileMenu.classList.contains('active') &&
        !mobileMenu.contains(event.target) &&
        !toggleBtn.contains(event.target)) {
        closeMobileMenu();
    }
});

// Close menu on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeMobileMenu();
    }
});

// Smooth scroll for anchor links (only for in-page anchors)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');

        // Only handle links that point to an ID on this page
        if (!href || href === '#' || !href.startsWith('#')) return;

        const targetId = href.substring(1);
        const target = document.getElementById(targetId);

        if (target) {
            e.preventDefault();

            // Close mobile menu if open
            closeMobileMenu();

            // Calculate offset for fixed navbar (72px height)
            const navbarHeight = 72;
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});
