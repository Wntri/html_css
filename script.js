document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.querySelector('.menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    menuBtn.addEventListener('click', function () {
        navLinks.classList.toggle('show');
    });

    // Close the mobile menu when a link is clicked
    mobileMenu.addEventListener('click', function () {
        navLinks.classList.remove('show');
    });
});
