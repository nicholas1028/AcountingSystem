<!-- NavBar For Authenticated Users -->
<spark-navbar
    :user="user"
    :teams="teams"
    :current-team="currentTeam"
    :has-unread-notifications="hasUnreadNotifications"
    :has-unread-announcements="hasUnreadAnnouncements"
    inline-template>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="" v-if="user">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            @includeIf('spark::nav.user-left')

            @includeIf('spark::nav.user-right')

        </div>
    </nav>
</spark-navbar>
