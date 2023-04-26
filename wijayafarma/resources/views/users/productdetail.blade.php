@extends('users.layouts.templete')
@section('title','WijayaFarma | Product')
@section('css')
<link rel="stylesheet" href="{{asset('users/css/detailproduct.css')}}">
@endsection
@section('main-content')
<br><br>
<!-- Start slides -->
<div class="container">

    <!-- Single Products Detail -->
    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <a href="{{route('product')}}"><i class="bi bi-arrow-left">Back</i></a><br><br>
          <img src="{{asset($product->product_img)}}" width="100%" id="ProductImg" />

        </div>

        <div class="col-2">

            <h2>{{$product->product_name}}</h2>
            <h4>{{$product->price}}</h4>
            <p>Categori - {{$product->product_category_name}}</p>
            <p>Tipe - {{$product->product_subcategory_name}}</p>
            <p>Stok - {{$product->quantity}}</p>
          <form action="" method="POST">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <input type="hidden" value="{{$product->price}}" name="price">
            <label for="quantity">Berapa Banyak</label>
            <input class="form-control" type="number" min="1" value="1" name="quantity">
              <input type="submit" name="" id="" class="btn btn-warning" value="Add to Cart" style="width: 8em">
            </form>
          <h3>Deskripsi Produk<i class="fa fa-indent"></i></h3>
          <br/>
          <p>
            {{$product->product_deskripsi}}
          </p>
        </div>
      </div>
    </div>


    </div>

<div class="container">
    <h2 class="h2 title_product">Related Product</h2>
    <div>
        <ul class="product-list">

            @foreach ($related_products as $produc)
        <li class="product-item">
          <div class="product-card" tabindex="0">

            <figure class="card-banner">
              <img src="{{asset($produc->product_img)}}" width="312" height="350" loading="lazy"  class="image-contain">

                      <ul class="card-action-list">
                        <form action="+" method="POST">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <input type="hidden" value="{{$produc->price}}" name="price">
                                    <input type="hidden" value="1" name="quantity">
                            <li class="card-action-item">
                                <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                            <ion-icon name="cart-outline"></ion-icon>
                          </button>
                          <div class="card-action-tooltip" id="card-label-1">Beli Sekarang</div>
                        </li>
                    </form>



                        <li class="card-action-item">
                          <a href="{{route('singleproduct',[$produc->id,$produc->slug])}}"><button class="card-action-btn" aria-labelledby="card-label-3">
                            <ion-icon name="eye-outline"></ion-icon>
                          </button>

                          <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>
                        </a>
                        </li>



                      </ul>
                    </figure>

                    <div class="card-content">

                      <div class="card-cat">
                        <a href="#" class="card-cat-link">{{$produc->product_category_name}}</a>
                      </div>

                      <h3 class="h3 card-title">
                        <a href="#">{{$produc->product_name}}</a>
                      </h3>

                      <data class="card-price" value="180.85">{{$produc->price}}</data>

                    </div>

                  </div>
                </li>
                @endforeach




                  </div>
                </li>
              </ul>

            </div>
        </div>
    <!-- JS for Toggle menu -->



@endsection
<script>
      var MenuItems = document.getElementById("MenuItems");

      MenuItems.style.maxHeight = "0px";

      function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
          MenuItems.style.maxHeight = "200px";
        } else {
          MenuItems.style.maxHeight = "0px";
        }
      }
    </script>


