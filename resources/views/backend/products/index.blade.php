@extends('layouts.backend', compact('title'))

@section('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Table Data Products</h3>
                            <a href="{{ route('product.create', []) }}" class="btn btn-sm btn-primary float-right">Create</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="data-products" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Shop</th>
                                        <th>Image</th>
                                        <th class="text-center" width="100"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- right col -->
    </div>

@endsection

@section('custom-scripts')
    <!-- DataTables -->
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {

            var table = $('#data-products').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('product.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'price', name: 'price'},
                    {data: 'discount', name: 'discount'},
                    {data: 'shop', name: 'shop.name'},
                    {data: 'image', name: 'image'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

           $('body').on('click', '#showItem', function () {
                var post_id = $(this).data('id');
                $.get("{{ route('post.index') }}" +'/' + post_id +'/show', function (data) {
                    $('#modal-lg').modal('show');
                    $('#modal-title').html("Post Info");
                    $('#post_id').val(data.id);
                    $('#title').html(data.title);
                    $('#meta_description').html(data.meta_description);
                    $('#body').html(data.body);
                })
           });
        });
    </script>
@endsection
