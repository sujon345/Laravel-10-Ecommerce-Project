@extends('admin.layouts.main')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/toastr/toastr.min.css')}}"
@endpush
@section('title','Brands')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-content-between px-5 py-3">
                                <div class="">
                                    <h3 class="card-title">Brands</h3>
                                </div>
                                <div class="">
                                    @if(session('delete'))
                                    <span class="alert alert-danger" role="alert">{{session('delete')}}</span>
                                    @endif
                                    @if(session('create'))
                                            <span class="alert alert-success" role="alert">{{session('create')}}</span>
                                    @endif
                                </div>
                               <div class="">
                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                       Add brand
                                   </button>
                               </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($brands as $key => $brand)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$brand->slug}}</td>
                                        <td>{{$brand->order}}</td>
                                        <td><button class="btn btn-info" data-name="{{$brand->name}}" data-id="{{$brand->id}}" data-order="{{$brand->order}}" data-toggle="modal" data-target="#edit">Edit</button>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-'+{{$brand->id}}).submit();" class="btn btn-danger">Delete</a>
                                            <form action="{{route('admin.brands.destroy',$brand->id)}}" method="post" id="delete-form-{{$brand->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Brand Not Found</td>

                                    </tr>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- /.add modal -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Brand</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.brands.store') }}" method="post">
                        @csrf
                    <div class="modal-body">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" placeholder="order" name="order">
                                </div>

                            </div>
                            <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary swalDefaultSuccess">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.add modal -->
        <!-- /.edit modal -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Brand</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.brands.update','test') }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"  name="name">
                                </div>
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" placeholder="order" name="order">
                                </div>


                            <!-- /.card-body -->

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.edit modal -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/admin/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)

            var name = button.data('name')
            var order = button.data('order')
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #order').val(order);
            modal.find('.modal-body #id').val(id);

        });

        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });


    </script>

@endpush
