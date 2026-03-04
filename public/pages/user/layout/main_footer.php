        </div>
    </div>
</div>

<script>
(function () {
    var toggleButton = document.getElementById('userSidebarToggle');
    if (!toggleButton) {
        return;
    }

    function isMobile() {
        return window.innerWidth < 992;
    }

    function syncAria() {
        var expanded = isMobile()
            ? document.body.classList.contains('user-mobile-sidebar-open')
            : !document.body.classList.contains('user-sidebar-collapsed');
        toggleButton.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    }

    function closeMobileOnNavigate(event) {
        if (!isMobile()) {
            return;
        }

        var link = event.target.closest('.user-side-link');
        if (!link) {
            return;
        }

        document.body.classList.remove('user-mobile-sidebar-open');
        syncAria();
    }

    toggleButton.addEventListener('click', function () {
        if (isMobile()) {
            document.body.classList.toggle('user-mobile-sidebar-open');
        } else {
            document.body.classList.toggle('user-sidebar-collapsed');
        }
        syncAria();
    });

    document.addEventListener('click', function (event) {
        if (!isMobile()) {
            return;
        }

        var insideSidebar = !!event.target.closest('.user-side-panel');
        var clickedToggle = event.target.closest('#userSidebarToggle');
        if (!insideSidebar && !clickedToggle) {
            document.body.classList.remove('user-mobile-sidebar-open');
            syncAria();
        }
    });

    document.addEventListener('click', closeMobileOnNavigate);

    window.addEventListener('resize', function () {
        if (!isMobile()) {
            document.body.classList.remove('user-mobile-sidebar-open');
        }
        syncAria();
    });

    syncAria();
})();
</script>
