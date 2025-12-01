document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.getElementById('loading-screen');
    const mainContent = document.getElementById('main-content');

    // Immediately start a short fade to reveal content for a faster, smoother UX
    if (loadingScreen) loadingScreen.classList.add('fade-out-fast');

    // After the short transition, hide loader and reveal the main content
    setTimeout(() => {
        if (loadingScreen) loadingScreen.style.display = 'none';
        if (mainContent) {
            mainContent.classList.remove('d-none');
            // smooth opacity reveal
            mainContent.style.transition = 'opacity 220ms ease-in-out';
            mainContent.style.opacity = 0;
            requestAnimationFrame(() => { mainContent.style.opacity = 1; });
        }
    }, 300); // matches CSS transition for "fast" fade
});
