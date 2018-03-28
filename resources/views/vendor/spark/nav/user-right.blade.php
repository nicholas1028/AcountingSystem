<!-- Right Side Of Navbar -->
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

        <!-- Notifications -->
        <li class="dropdown notifications-menu">
            <a @click="showNotifications" class="has-activity-indicator">
                <div class="navbar-icon">
                    <i class="activity-indicator" v-if="hasUnreadNotifications || hasUnreadAnnouncements"></i>
                    <i class="icon fa fa-bell"></i>
                </div>
            </a>
        </li>

        <li class="dropdown user user-menu">
            <!-- User Photo / Name -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <img :src="user.photo_url" class="user-image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">@{{ user.name }}</span>
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">

                <!-- The user image in the menu -->
                <li class="user-header">
                    <img :src="user.photo_url" class="img-circle" alt="User Image">

                    <p>
                        @{{ user.name }}
                        <small>Member since Nov. 2012</small>
                    </p>
                </li>

                <!-- Impersonation -->
                @if (session('spark:impersonator'))
                    <li class="dropdown-header">{{ __('Impersonation') }}</li>

                    <!-- Stop Impersonating -->
                    <li>
                        <a href="/spark/kiosk/users/stop-impersonating">
                            <i class="fa fa-fw fa-btn fa-user-secret"></i> {{ __('Back To My Account') }}
                        </a>
                    </li>

                    <li class="divider"></li>
            @endif

            <!-- Developer -->
            @if (Spark::developer(Auth::user()->email))
                @include('spark::nav.developer')
            @endif

            <!-- Subscription Reminders -->
            @include('spark::nav.subscriptions')

            <!-- Settings -->
                <li class="dropdown-header">{{ __('Settings') }}</li>

                <!-- Your Settings -->
                <li>
                    <a href="/settings">
                        <i class="fa fa-fw fa-btn fa-cog"></i>{{ __('Your') }} {{ __('Settings') }}
                    </a>
                </li>

                <li class="divider"></li>

            @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
                <!-- Team Settings -->
                @include('spark::nav.teams')
            @endif

            @if (Spark::hasSupportAddress())
                <!-- Support -->
                @include('spark::nav.support')
            @endif

            <!-- Logout -->
                <li>
                    <a href="/logout">
                        <i class="fa fa-fw fa-btn fa-sign-out"></i>{{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>