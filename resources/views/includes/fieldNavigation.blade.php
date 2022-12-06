<nav>
<img src="/images/logo.png" alt="">
    <ul>
        <a href="/">Home</a>
        <a href="/Schedule">Schedule</a>
        <a href="/Forms">Forms</a>
        <li><form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form></li>
    </ul>
</nav>