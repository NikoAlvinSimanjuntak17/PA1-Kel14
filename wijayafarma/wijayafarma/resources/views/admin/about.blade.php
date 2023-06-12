@extends('admin.layouts.template')
@section('title','Admin | addproduct')
@section('content')
<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages / </span> About</h4>
    <div class="card">
        <h5 class="card-header">All Product Information</h5>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                {{-- @foreach ($products as $product) --}}
              <tr>
                    <td></td>
                    <td></td>
                    {{-- <td> <div class=""><img src="{{asset($product->product_img)}}" height="100em" width="100em" alt=""> <br> --}}
                        {{-- <a href="{{route('editproductimg',$product->id)}}" class="btn btn-primary">Update Image</a> --}}
                    </div>
                    {{-- <td>{{$product->product_category_name}}</td> --}}
                    {{-- <td>{{$product->product_subcategory_name}}</td> --}}
                    </td>
                    {{-- <td>{{$product->quantity}}</td> --}}
                    {{-- <td>{{$product->price}}</td> --}}
                    <td>
                        {{-- <a href="{{route('editproduct',$product->id)}}" class="btn btn-primary">Edit</a> --}}
                    {{-- <a href="{{route('deleteproduct' ,$product->id)}}" class="btn btn-warning">Delete</a> --}}
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
          </table>
        </div>
      </div>
</div>



<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages / </span> Add Produk</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tamba h Produk Baru</h5>
        <small class="text-muted float-end">informasi input</small>
      </div>
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{route('storeproduct')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Produk</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nama Produk"/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Produk</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="price" name="price" placeholder="Harga" name="price"/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Stok Produk</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="quantity"/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi Produk</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="product_deskripsi" id="product_deskripsi" placeholder="deskripsi" cols="30" rows="10"></textarea>
            </div>
          </div>


          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Categori</label>
            <div class="col-sm-10">
                <select class="form-select" id="product_category_id" name="product_category_id" aria-label="Default select example">
                    <option selected>pilih categori</option>
                    {{-- @foreach ($categories as $categori ) --}}
                    {{-- <option value="{{$categori->id}}">{{$categori->category_name}}</option> --}}
                    {{-- @endforeach --}}
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Sub Categori</label>
            <div class="col-sm-10">
                <select class="form-select" id="product_subcategory_id" name="product_subcategory_id" aria-label="Default select example">
                    <option selected>Pilih Sub Categori</option>
                    {{-- @foreach ($subcategories as $subcategori ) --}}
                    {{-- <option value="{{$subcategori->id}}">{{$subcategori->subcategory_name}}</option> --}}
                    {{-- @endforeach --}}
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kirim Gambar</label>
            <div class="col-sm-10">
                <input type="file" id="product_img" class="form-control" name="product_img">
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Add Produk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
