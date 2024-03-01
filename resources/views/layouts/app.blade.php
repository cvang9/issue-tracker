<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;400;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Source Sans Pro", sans-serif;
        }

        /* body {
            background-color: #333;
        } */
    </style>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
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