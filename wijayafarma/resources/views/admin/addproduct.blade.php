@extends('admin.layouts.template')
@section('title','Admin | addproduct')
@section('content')
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
        <div id="alert" class="alert alert-danger">
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
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Penyakit</label>
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
                    @foreach ($categories as $categori )
                    <option value="{{$categori->id}}">{{$categori->category_name}}</option>
                    @endforeach
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Sub Categori</label>
            <div class="col-sm-10">
                <select class="form-select" id="product_subcategory_id" name="product_subcategory_id" aria-label="Default select example">
                    <option selected>Pilih Subkategori</option>
                    @foreach ($subcategories->groupBy('subcategory_name') as $subcategory)
                        <option value="{{$subcategory->first()->id}}">{{$subcategory->first()->subcategory_name}}</option>
                    @endforeach
                </select>


            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kirim Gambar</label>
            <div class="col-sm-10">
                <input type="file" id="product_img" class="form-control" name="product_img[]" multiple>
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
