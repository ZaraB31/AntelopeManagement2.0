<nav>
<img src="/images/logo.png" alt="">
    <ul>
        <li><a href="/"><i class="fa-solid fa-list-ul"></i> My To-Do List</a></li>
        <li><a href="/ProjectsDashboard"><i class="fa-solid fa-chart-line"></i> Projects Dashboard</a></li>
        <li><a href="/ContactBook"><i class="fa-solid fa-address-book"></i> Contact Book</a></li>
        <li><a href="/Jobs"><i class="fa-solid fa-calendar-days"></i> Jobs</a></li>
    </ul>
    <ul>
        <li><a href="/Admin"><i class="fa-solid fa-lock"></i> Admin</a></li>
        <li><form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </form></li>
    </ul>
</nav>