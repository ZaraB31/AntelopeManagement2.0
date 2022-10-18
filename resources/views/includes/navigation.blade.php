<nav>
<img src="/images/logo.png" alt="">
    <ul>
        <li><a href="/">My To-Do List</a></li>
        <li><a href="/ProjectsDashboard">Projects Dashboard</a></li>
        <li><a href="/ContactBook">Contact Book</a></li>
    </ul>
    <ul>
        <li><a href="/Admin">Admin</a></li>
        <li><form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form></li>
    </ul>
</nav>