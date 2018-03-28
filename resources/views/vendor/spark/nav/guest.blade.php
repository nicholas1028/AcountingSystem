<nav class="navbar navbar-static-top" role="navigation">
    <div class="">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        @includeIf('spark::nav.guest-left')
        @includeIf('spark::nav.guest-right')

    </div>
</nav>
