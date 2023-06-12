@extends('users.layouts.template')
@section('title', 'WijayaFarma | Search')
@section('css')
<link rel="stylesheet" href="{{ asset('users/css/category.css') }}">
<style>
    .header {
        background-color: black;
        opacity: 0.8;
    }
</style>
@endsection
@section('main-content')
<br><br><br>
<!-- Content -->
<div class="container">
    <!-- End Featured Services Section -->
    <section class="section reveal product">
        <div class="container">
            <br>
            <div>
                <h2 class="h2 title_product">Search Results</h2>
            </div>
            <div>
                <div class="container p-3">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">All Category
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="{{ route('category', [$category->id, $category->slug]) }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="product-list">
                        @foreach ($products as $product)
                        <li class="product-item">
                            <div class="product-card" tabindex="0">
                                <figure class="card-banner">
                                    @if (json_decode($product->product_img))
                                    @foreach (json_decode($product->product_img) as $image)
                                    <img src="{{ asset($image) }}" width="312" height="350" loading="lazy"
                                        class="image-contain" alt="">
                                    @endforeach
                                    @else
                                    <img src="{{ asset($product->product_img) }}" width="312" height="350"
                                        loading="lazy" class="image-contain">
                                    @endif
                                    <ul class="card-action-list">
                                        <li class="card-action-item">
                                            <form action="{{ route('addproducttocart', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->product_name }}"
                                                    name="product_name">
                                                <input type="hidden" value="{{ $product->product_img }}"
                                                    name="product_img">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="card-action-btn"
                                                    aria-labelledby="card-label-1">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-1">Beli Sekarang
                                                </div>
                                            </form>
                                        </li>
                                        <li class="card-action-item">
                                            <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}">
                                                <button class="card-action-btn" aria-labelledby="card-label-3">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </figure>
                                <div class="card-content">
                                    <div class="card-cat">
                                        <a href="#" class="card-cat-link">{{ $product->product_category_name }}</a>
                                    </div>
                                    <h3 class="h3 card-title">
                                        <a href="#">{{ $product->product_name }}</a>
                                    </h3>
                                    <data class="card-price" value="180.85">
                                        {{ 'Rp '.number_format($product->price, 0, ',', '.') }}</data>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
@endsection
