<div class="col-md-3 sidenav">
    <div class="m-list-group">
        <ul class="nav-mj">
            <li class="m-list-group-item"><a href="/home"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="m-list-group-item"><a href="/search">Search</a></li>

            @if(Auth::guest())
                <li class="m-list-group-item"><a href="/plots/on-sale">Plots on sale</a></li>
                <li class="m-list-group-item"><a href="/announcements">Announcements</a></li>
            @elseif(Auth::user()->role_id == 0)
                <li class="m-list-group-item"><a href="/plots">My plots</a></li>
                <li class="m-list-group-item"><a href="/announcements">Announcements</a></li>
                <li class="m-list-group-item"><a href="/plots/on-sale">Plots on sale</a></li>
                <li class="m-list-group-item"><a href="/applications">My land applications</a></li>
            @elseif(Auth::user()->role_id == 1)
                <li class="m-list-group-item"><a href="#">Manage plots</a></li>
                <li class="m-list-group-item"><a href="/applications/all">Manage land applications</a></li>
                <li class="m-list-group-item"><a href="/announcements/create">Add announcement</a></li>
            @elseif(Auth::user()->role_id == 2)
                <li class="m-list-group-item"><a href="#">Manage plots</a></li>
                <li class="m-list-group-item"><a href="/users/manage">Manage users</a></li>
                <li class="m-list-group-item"><a href="/applications/all">Manage land applications</a></li>
                <li class="m-list-group-item"><a href="/announcements/create">Add announcement</a></li>
            @else
                <li class="m-list-group-item"><a href="#">Role not recognized by the system</a></li>
            @endif

        </ul>

        <div class="footer">
            LIMS &copy;2017
        </div>
    </div>

</div>

