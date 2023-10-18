@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blog List</li>
                        </ol>
                    </div>
                    @if (session('message'))
                    <div class="col-sm-12 alert alert-success">
                        {{ session('message')}}
                    </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">

                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.formblog.create') }}">Add</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table-product" class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Image</th>
                                            <th>Created_at</th>
                                            <th>Name</th>
                                            <th>Short description </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($blogs as $blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                    $imagesLink = is_null($blog->image) || !file_exists('images/'.$blog->image)
                                                    ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                                    : asset('images/'. $blog->image);
                                                    @endphp
                                                <img src="{{ $imagesLink }}" alt="{{ $blog->name}}" width="150" height="150" />
                                                </td>
                                                <td>{{ $blog->created_at }}</td>
                                                <td>{{ $blog->name }}</td>
                                                <td>{!! $blog->short_description !!}</td>
                                                <td>
                                                    <form
                                                    action="{{ route('admin.formblog.destroy',['formblog' => $blog->id ]) }}"
                                                    method="post">
                                                      @csrf
                                                      @method('delete')
                                                      <button type="sumbit" name="sumbit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <a href="{{ route('admin.formblog.edit',['formblog' => $blog->id]) }}" class="btn btn-primary">Edit</a>
                                                    @if(!is_null($blog->deleted_at))
                                                        <a href="{{ route('admin.formblog.restore',['formblog' =>  $blog->id]) }}" class="btn btn-success">Restore</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No data</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{-- 'admin.pagination.my-pagination' --}}
                                {{ $blogs->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js-custom')
    <script  type="text/javascript">
        let table = new DataTable('#table-product');
        // $('#table-product').dataTable( {
        // "pageLength": 1
        // } );
    </script>
@endsection
