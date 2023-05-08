@php
$categories = App\Models\Category::latest()->paginate(20);
$product = App\Models\Product::latest()->get()
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


            <h2 class="h2 title_product">Obat {{$category->category_name}} - ({{$category->product_count}})</h2>

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
                      <div class="dropdown-menu ">
                         <a href="#" class="dropdown-item">
                         <img src="images/flag-france.png" class="mr-2" alt="flag">
                         French
                         </a>
                      </div>
                   </div>
            </div>
            </div>

          </div>
          <div>
              <ul class="product-list">

                  @foreach ($products as $product)
              <li class="product-item">
                <div class="product-card" tabindex="0">

                  <figure class="card-banner">
                    <img src="{{asset($product->product_img)}}" width="312" height="350" loading="lazy"  class="image-contain">

                            <ul class="card-action-list">

                              <li class="card-action-item">
                                <form action="{{route('addproducttocart',$product->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <form action="{{route('addproducttocart',$product->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                        <input type="hidden" value="{{$product->price}}" name="price">
                                        <input type="hidden" value="1" name="quantity">
                                        <li class="card-action-item">
                                            <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                                        <ion-icon name="cart-outline"></ion-icon>
                                      </button>
                                      <div class="card-action-tooltip" id="card-label-1">Beli Sekarang</div>
                                    </li>
                                </form>
                            </form>



                              <li class="card-action-item">
                                <a href="{{route('singleproduct',[$product->id,$product->slug])}}"><button class="card-action-btn" aria-labelledby="card-label-3">
                                  <ion-icon name="eye-outline"></ion-icon>
                                </button>

                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>
                              </a>
                              </li>



                            </ul>
                          </figure>

                          <div class="card-content">

                            <div class="card-cat">
                              <a href="#" class="card-cat-link">{{$product->product_category_name}}</a>
                            </div>

                            <h3 class="h3 card-title">
                              <a href="#">{{$product->product_name}}</a>
                            </h3>

                            <data class="card-price" value="180.85">{{$product->price}}</data>

                          </div>

                        </div>
                      </li>
                      @endforeach




                        </div>
                      </li>
                    </ul>

                  </div>
                  </section>
                  {{$categories->links()}}
          </div>
        </div>

@endsection
@section('js')
@endsection
