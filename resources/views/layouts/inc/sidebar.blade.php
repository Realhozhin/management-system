<div class="active" id="sidebar">
    <ul class="list-unstyled lead">
        <li>
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
        </li>

        <li>
            {{-- <a href="{{ route('orders.index') }}"><i class="bi bi-border-style"></i> Orders</a> --}}
        </li>

        <li>
            <a href="{{ route('users.index') }}"><i class="bi bi-kanban"></i> Users</a>
        </li>

        <li>
            <a href="{{ route('management') }}"><i class="bi bi-kanban-fill"></i> Management</a>
        </li>

        <li>
            <a href="{{ route('companies.index') }}"><i class="bi bi-buildings"></i> companies</a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}"><i class="bi bi-buildings"></i> category</a>
        </li>
        <li>
            <a href="{{ route('tasks.index') }}"><i class="bi bi-buildings"></i> Task</a>
        </li>
    </ul>
</div>
