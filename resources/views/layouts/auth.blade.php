<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v5.0.0
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2024 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
-->

<html lang="en">

    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <script src="https://kit.fontawesome.com/a584191b57.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="bg-body-tertiary min-vh-100 d-flex align-items-center flex-row">
            @yield('content')
        </div>

        <script>
            const header = document.querySelector('header.header');

            document.addEventListener('scroll', () => {
                if (header) {
                    header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
                }
            });
        </script>
    </body>

</html>
