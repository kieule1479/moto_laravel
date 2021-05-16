@extends('admin.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            @include('admin.pages.slider.element.search-filter')
            @include('admin.pages.slider.element.list')

        </div>
    </section>
    <!-- /.content -->
@endsection
