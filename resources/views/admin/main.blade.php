<!DOCTYPE html>
<html>

<head>
    @include('admin.element.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">

    <div class="wrapper">

        @include('admin.element.navbar')
        @include('admin.element.sidebar')

        <div class="content-wrapper">

            @include('admin.element.header')
            @yield('content')

        </div>

    </div>

    @include('admin.element.footer')
    @include('admin.element.script')

</body>

</html>
