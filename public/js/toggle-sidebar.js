// Sidebar toggle button for mobile
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const wrapper = document.getElementById('wrapper');
    if (toggleBtn && wrapper) {
        toggleBtn.addEventListener('click', function () {
            const isHidden = wrapper.classList.toggle('sidebar-hidden');
            toggleBtn.classList.toggle('open', !isHidden);
        });
        // Set initial icon state
        toggleBtn.classList.toggle('open', !wrapper.classList.contains('sidebar-hidden'));
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('wrapper');
    const sidebar = document.getElementById('sidebar-wrapper');
    // whether the user set the sidebar to persist-open
    let isPersistOpen = false;
    // Initialize: hide sidebar by default (modern app preference)
    if (wrapper && !wrapper.classList.contains('sidebar-hidden')) {
        wrapper.classList.add('sidebar-hidden');
    }

    // Optional keyboard shortcut to toggle sidebar: Ctrl/Cmd + B
    document.addEventListener('keydown', function (e) {
        if (!wrapper) return;
        if ((e.ctrlKey || e.metaKey) && e.key && e.key.toLowerCase() === 'b') {
            e.preventDefault();
            isPersistOpen = !isPersistOpen;
            wrapper.classList.toggle('sidebar-hidden', !isPersistOpen);
        }
    });

    // Edge hover peek: when sidebar is hidden, moving cursor to the extreme left shows a temporary peek
    let peekTimer = null;
    let hideTimer = null;
    const PEEK_ZONE = 14; // px from the left edge to trigger peek
    const PEEK_AUTO_HIDE_MS = 2200;

    function showPeek() {
        if (!wrapper || !sidebar) return;
        // only peek when the sidebar is currently hidden and not persist-open
        if (!wrapper.classList.contains('sidebar-hidden')) return;
        if (isPersistOpen) return;
        // reveal the sidebar by removing the hidden class temporarily
        wrapper.classList.remove('sidebar-hidden');
        // mark temporary peek
        wrapper.dataset.peek = '1';
        // auto-hide after a timeout
        clearTimeout(hideTimer);
        hideTimer = setTimeout(hidePeek, PEEK_AUTO_HIDE_MS);
    }

    function hidePeek() {
        if (!wrapper || !sidebar) return;
        // only hide if this was a temporary peek
        if (wrapper.dataset.peek) {
            delete wrapper.dataset.peek;
            wrapper.classList.add('sidebar-hidden');
        }
        clearTimeout(hideTimer);
    }

    // Mouse move near left edge triggers peek
    document.addEventListener('mousemove', function (ev) {
        // ignore if not collapsed or on very small screens
        if (!wrapper || !sidebar) return;
        if (!wrapper.classList.contains('sidebar-hidden')) return;
        if (window.innerWidth <= 420) return;
        if (ev.clientX <= PEEK_ZONE) {
            // debounce rapid events
            clearTimeout(peekTimer);
            peekTimer = setTimeout(showPeek, 80);
        }
    });

    // Double-click near left edge toggles persistent sidebar state
    document.addEventListener('dblclick', function (ev) {
        if (!wrapper) return;
        if (ev.clientX <= PEEK_ZONE && window.innerWidth > 420) {
            isPersistOpen = !isPersistOpen;
            wrapper.classList.toggle('sidebar-hidden', !isPersistOpen);
        }
    });

    // Keep peek visible while hovering over sidebar
    if (sidebar) {
        sidebar.addEventListener('mouseenter', function () {
            clearTimeout(hideTimer);
            // keep the temporary peek visible while user interacts
            // do nothing else; showPeek already removed the hidden class
        });
        sidebar.addEventListener('mouseleave', function () {
            // only hide if this was a temporary peek
            if (wrapper && wrapper.dataset && wrapper.dataset.peek) {
                hideTimer = setTimeout(hidePeek, 400);
            }
        });
    }
});
