<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a href="{{route('admin.home')}}" class="nav-link">Dashboard</a></li>
    <li class="nav-item"><a href="{{route('admin.users.index')}}" class="nav-link active">Users</a></li>
    <li class="nav-item"><a href="{{route('admin.regions.index')}}" class="nav-link ">Regions</a></li>

</ul>

<a href="{{ route('admin.users.create') }}" class="btn btn-info  mb-3" > Add User</a>