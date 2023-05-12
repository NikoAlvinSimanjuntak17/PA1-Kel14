@extends('users.layouts.templete')
@section('title','WijayaFarma | Dasboard')
@section('main-content')
<!-- Start slides -->

<div id="slides" class="cover-slides">
    <ul class="slides-container">
      <li class="text-left">
        <img src="{{asset('users/img/pexels-karolina-grabowska-4021811.jpg')}}" alt="">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20"><strong>WijayaFarma</strong></h1>
              <p class="m-b-40">Tersedia berbagai jenis produk obat-obatan dan peralatan medis yang telah tersedia pada retail dan juga terdapat berbagai macam informasi penyakit yang dapat diakses oleh kamu dimanapun dan kapanpun kamu berada.</p>
              <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{route('about')}}">About</a></p>
            </div>
          </div>
        </div>
      </li>
      <li class="text-left">
        <img src="{{asset('users/img/pexels-pixabay-161688.jpg')}}" alt="">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20"><strong>WijayaFarma</strong></h1>
              <p class="m-b-40">Tersedia berbagai jenis produk obat-obatan dan peralatan medis yang telah tersedia pada retail dan juga terdapat berbagai macam informasi penyakit yang dapat diakses oleh kamu dimanapun dan kapanpun kamu berada.</p>
              <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{route('about')}}">About</a></p>
            </div>
          </div>
        </div>
      </li>
      <li class="text-left">
        <img src="{{asset('users/img/pexels-mart-production-7230192.jpg')}}" alt="">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20"><strong>WijayaFarma</strong></h1>
              <p class="m-b-40">Tersedia berbagai jenis produk obat-obatan dan peralatan medis yang telah tersedia pada retail dan juga terdapat berbagai macam informasi penyakit yang dapat diakses oleh kamu dimanapun dan kapanpun kamu berada.</p>
              <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{route('about')}}">About</a></p>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <div class="slides-navigation">
      <a href="#" class="next"><i class="bi bi-arrow-right-circle" aria-hidden="true"></i></a>
      <a href="#" class="prev"><i class="bi bi-arrow-left-circle" aria-hidden="true"></i></a>
    </div>
</div>
  <!-- End slides -->
  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container reveal kekiri" data-aos="fade-up">
          <hr><br>
          <div class="row">

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                <div class="icon"><img src="{{asset('users/img/24-hours.png')}}  "></div>
                <h4 class="title"><a href="">24-hours</a></h4>
                <p class="description">Toko online wijayafarma dapat diakses selama 24 jam dimanapun dan kapanpun anda berada.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                <div class="icon"><img src="{{asset('users/img/add-to-cart.png')}}"> </div>
                <h4 class="title"><a href="">Online Shop</a></h4>
                <p class="description">Pada toko online wijayafarma anda dapat berbelanja obat dan keperluan medis lainnya dengan mudah.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <div class="icon"><img src="{{asset('users/img/customer-service.png')}}"> </i></div>
                <h4 class="title"><a href="">Live Chat</a></h4>
                <p class="description">Toko online wijayafarma menyediakan forum untuk pelanggan yang ingin mengajukan pertanyaan seputar masalah kesehatan anda.</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Featured Services Section -->
      <section class="section reveal product">
        <div class="container">
  <hr><br>
          <h2 class="h2 title_product">Products</h2>

          <ul class="product-list">
            @foreach ($allproduct->take(8) as $produc)
            <li class="product-item">
                <div class="product-card" tabindex="0">

                  <figure class="card-banner">
                    <img src="{{asset($produc->product_img)}}" width="312" height="350" loading="lazy"  class="image-contain">

                            <ul class="card-action-list">

                              <li class="card-action-item">
                                <form action="{{route('addproducttocart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$produc->id}}" name="product_id">
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

                            <data class="card-price" value="{{ $produc->price }}">{{ 'Rp '.number_format($produc->price, 0, ',', '.') }}</data>
                          </div>

                        </div>
                      </li>
                      @endforeach
              </div>
            </li>

          </ul>

        </div>
      </section>
<!-- Carousel wrapper -->
<div
  id="carouselMultiItemExample"
  class="carousel slide carousel-dark text-center"
  data-mdb-ride="carousel"
>
  <!-- Controls -->
  <div class="d-flex justify-content-center mb-4">
    <button
      class="carousel-control-prev position-relative"
      type="button"
      data-mdb-target="#carouselMultiItemExample"
      data-mdb-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next position-relative"
      type="button"
      data-mdb-target="#carouselMultiItemExample"
      data-mdb-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Inner -->
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp"
                class="card-img-top"
                alt="Waterfall"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/182.webp"
                class="card-img-top"
                alt="Sunset Over the Sea"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/183.webp"
                class="card-img-top"
                alt="Sunset over the Sea"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp"
                class="card-img-top"
                alt="Fissure in Sandstone"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/185.webp"
                class="card-img-top"
                alt="Storm Clouds"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/186.webp"
                class="card-img-top"
                alt="Hot Air Balloons"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/187.webp"
                class="card-img-top"
                alt="Peaks Against the Starry Sky"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/188.webp"
                class="card-img-top"
                alt="Bridge Over Water"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/189.webp"
                class="card-img-top"
                alt="Purbeck Heritage Coast"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Inner -->
</div>
<!-- Carousel wrapper -->

@endsection
