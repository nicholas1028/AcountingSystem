@if (Auth::user()->onTrial())
    <!-- Trial Reminder -->
    <li class="dropdown-header">{{ __('Trial') }}</li>

    <li>
        <a href="/settings#/subscription">
            <i class="fa fa-fw fa-btn fa-shopping-bag"></i> {{ __('Subscribe') }}
        </a>
    </li>

    <li class="divider"></li>
@endif

@if (Spark::usesTeams() && Auth::user()->currentTeamOnTrial())
    <!-- Team Trial Reminder -->
    <li class="dropdown-header">{{ __('Company Trial') }}</li>

    <li>
        <a href="/settings/{{ str_plural(Spark::teamString()) }}/{{ Auth::user()->currentTeam()->id }}#/subscription">
            <i class="fa fa-fw fa-btn fa-shopping-bag"></i>{{ __('Subscribe') }}
        </a>
    </li>

    <li class="divider"></li>
@endif
