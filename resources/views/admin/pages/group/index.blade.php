@extends('admin.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            @include('admin.pages.group.element.search-filter')
            @include('admin.pages.group.element.list')

        </div>
    </section>
    <!-- /.content -->
@endsection
