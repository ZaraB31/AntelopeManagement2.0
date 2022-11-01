<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/dist/app.css">
    <script src="/js/openHiddenForm.js"></script>
    <script src="/js/openTable.js"></script>
    <script src="/js/tabOpen.js"></script>
    <script src="https://kit.fontawesome.com/7d0f299f51.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Share:wght@400;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body onLoad="openError()">
    <header>
        @include('includes.navigation')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
