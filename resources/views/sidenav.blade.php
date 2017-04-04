<div class="col-md-3 sidenav">
    <div class="list-group">
        <ul class="nav">

            @if(Auth::guest())
                <li class="list-group-item"><a href="#">Search for a plot **</a></li>
                <li class="list-group-item"><a href="#">Plots on sale</a></li>
            @elseif(Auth::user()->role_id == 0)
                <li class="list-group-item"><a href="#">Search for a plot **</a></li>
                <li class="list-group-item"><a href="#">Plots on sale</a></li>
                <li class="list-group-item"><a href="#">My applications</a></li>
            @elseif(Auth::user()->role_id == 1)
                <li class="list-group-item"><a href="#">Manage plots on sale</a></li>
                <li class="list-group-item"><a href="#">Edit plot information</a></li>
                <li class="list-group-item"><a href="#">Add plots</a></li>
            @elseif(Auth::user()->role_id == 2)
                <li class="list-group-item"><a href="#">Manage plots on sale</a></li>
                <li class="list-group-item"><a href="#">Edit plot information</a></li>
                <li class="list-group-item"><a href="#">Add plots</a></li>
                <li class="list-group-item"><a href="#">Manage users</a></li>
                <li class="list-group-item"><a href="#">Manage land-info managers</a></li>
            @else
                <li class="list-group-item"><a href="#">Role not recognized by the system</a></li>
            @endif

        </ul>
    </div>
</div>