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
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                        @include('frontend.components.alert')
                        <div class="card">
                          <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Table Data Categories</h3>
                                <button class="btn btn-sm btn-primary" id="createNewItem">Create <i class="fas fa-plus"></i></button>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="data-categories" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th><i class="fas fa-cogs"></i></th>
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

    <!-- MODAL -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="itemForm" name="itemForm">
                    @csrf
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control mr-2" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('custom-scripts')
    <!-- DataTables -->
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('#data-categories').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('category.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNewItem').click(function () {
                setTimeout(function () {
                    $('#name').focus();
                }, 1000);
                $('#saveBtn').val("Add");
                $('#category_id').val('');
                $('#itemForm').trigger("reset");
                $('#modal-title').html("Create New Category");
                $('#modal-md').modal('show');
            });

            $('body').on('click', '#editItem', function () {
                var category_id = $(this).data('id');
                $.get("{{ route('category.index') }}" +'/' + category_id +'/edit', function (data) {
                    $('#modal-md').modal('show');
                    setTimeout(function () {
                        $('#name').focus();
                    }, 1000);
                    $('#modal-title').html("Edit Category");
                    $('#saveBtn').val("Edit");
                    $('#category_id').val(data.id);
                    $('#name').val(data.name);
                })
           });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                // $(this).html('Sending..');

                $.ajax({
                    data: $('#itemForm').serialize(),
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#itemForm').trigger("reset");
                        $('#modal-md').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
              });
            });
        });
    </script>
@endsection
