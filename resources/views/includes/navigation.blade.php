<nav>
<img src="/images/logo.png" alt="">
    <ul>
        <li><a href="">My To-Do List</a></li>
        <li><a href="">Projects Dashboard</a></li>
        <li><a href="">Contact Book</a></li>
    </ul>
    <ul>
        <li><a href="">Admin</a></li>
        <li><form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form></li>
    </ul>
</nav>