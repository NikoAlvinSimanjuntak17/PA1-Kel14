@php
$categories = App\Models\Category::latest()->get();
$products = App\Models\Product::latest()->paginate(20);
@endphp
@extends('users.layouts.templete')
@section('title','WijayaFarma | Category')
@section('css')
<link rel="stylesheet" href="{{asset('users/css/category.css')}}">
@endsection
@section('main-content')
<!--  Content -->
<div class="container">
    <!-- End Featured Services Section -->
                <section class="section reveal product">
                  <div class="container">
          <br>

<div>
<h2 class="h2 title_product">All Products</h2>
<div style="float: right">
    @if (session()->has('message'))
    <div id="alert" class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@elseif (session()->has('error'))
    <div id="alert" class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif



</div>
</div>
<div>
            <div class="search-box p-4 ">
              <button class="btn-search"><i class="bi bi-search"></i></button>
              <input type="text" class="input-search" placeholder="Type to Search...">

            </div>

            <div class="container p-3">
                <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                       @foreach ($categories as $categori)
                    <a class="dropdown-item" href="{{route('category',[$categori->id, $categori->slug]) }}">{{$categori->category_name}}</a>
                    @endforeach
            </div>
            </div>

          </div>

          <div>
              <ul class="product-list">

                  @foreach ($products as $produc)
              <li class="product-item">
                <div class="product-card" tabindex="0">

                  <figure class="card-banner">
                    @if(json_decode($produc->product_img))
                    @foreach(json_decode($produc->product_img) as $image)
<img src="{{ asset($image) }}" width="312" height="350" loading="lazy"  class="image-contain"  alt="">
@endforeach
                    @else
                    <img src="{{asset($produc->product_img)}}" width="312" height="350" loading="lazy"  class="image-contain">
                    @endif
                            <ul class="card-action-list">

                              <li class="card-action-item">
                                <form action="{{route('addproducttocart',$produc->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$produc->id}}" name="product_id">
                                    <input type="hidden" value="{{$produc->product_name}}" name="product_name">
                                    <input type="hidden" value="{{$produc->product_img}}" name="product_img">
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

                            <data class="card-price" value="180.85">{{ 'Rp '.number_format($produc->price, 0, ',', '.') }}</data>

                          </div>

                        </div>
                      </li>
                      @endforeach




                        </div>
                      </li>
                    </ul>


                    {{$products->links()}}
                </div>
            </section>


        </div>






    </div>
    @endsection
@section('js')
@endsection
