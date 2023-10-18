@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>
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
                                        <form method="get">
                                            <input type="text" value="{{ $keyword }}" placeholder="Search..." name="keyword">
                                            <select name="status">
                                                <option value="">---Please Select---</option>
                                                <option value="1">Show</option>
                                                <option value="0">Hide</option>
                                            </select>
                                            <button class="btn btn-primary" type="submit" >Search</button>

                                        </form>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.product.create') }}">Add</a>
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
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Item list</th>
                                            <th>information</th>
                                            <th>Shopping</th>
                                            <th>Weight</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                                        ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                                        : asset('images/'. $product->image);
                                                    @endphp
                                                    <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="150" height="150" />
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>

                                                <td>
                                                    <div class="{{$product->status ? 'btn btn-success' : 'btn btn-danger'}}">
                                                    {{ $product->status ? 'Show' : 'Hide' }}</div>
                                                </td>

                                                {{-- <td>{{ $product->product_category_name }}</td> --}}
                                                <td>{{ $product->product_category->name }}</td>

                                                <td>{!! $product->information !!}</td>
                                                <td>{{ $product->shipping }}</td>
                                                <td>{{ $product->weight }}</td>

                                                <td>
                                                  <form
                                                  action="{{ route('admin.product.destroy',['product' => $product->id ]) }}"
                                                  method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="sumbit" name="sumbit" class="btn btn-danger">Delete</button>
                                                  </form>
                                                    <a href="{{ route('admin.product.edit',['product' =>  $product->id]) }}" class="btn btn-primary">Edit</a>
                                                    @if(!is_null($product->deleted_at))
                                                        <a href="{{ route('admin.product.restore',['product' =>  $product->id]) }}" class="btn btn-success">Restore</a>
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
                                {{ $products->links() }}
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
