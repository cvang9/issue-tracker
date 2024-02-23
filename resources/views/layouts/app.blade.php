<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;400;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
    @yield('title')
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>