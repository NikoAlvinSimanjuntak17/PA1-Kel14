@extends('users.layouts.templete')
@section('title','WijayaFarma | Add To Cart')
@section('csss')
<style>
    .header {
        background-color: #3b3b3b;
    }
</style>
@endsection

@section('css')
<style>
    .quantity-container {
  display: flex;
  align-items: center;
  background-repeat: no-repeat;
}

.quantity-btn {
  display: inline-block;
  padding: 6px 12px;
  font-size: 18px;
  text-decoration: none;
  background-color: #f5f5f5;
  border: 1px solid #ddd;
  border-radius: 4px;
  color: #333;
  transition: background-color 0.3s ease;
}

.quantity-btn:hover {
  background-color: #e5e5e5;
}

.quantity-text {
  margin: 0 10px;
  font-size: 16px;
}
</style>
@endsection
@section('main-content')
<div class="container">
<br><br><br><br><br><br><br><br>
@if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <div>
                    <a href="{{route('product')}}"><i class="bi bi-cart-plus"> Tambah Keranjang</i></a>
                </div>
                <form action="{{route('checkout')}}">
                <table class="table">
                    <thead>
                    <tr>
                        <td><input type="checkbox" name="" id="select_all_ids"></td>
                        <td>No</td>
                        <td>Id Produk</td>
                        <td>Gambar Produk</td>
                        <td>Nama Produk</td>
                        <td>Jumlah</td>
                        <td>Harga</td>
                        <td>@Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    @php
                        $total = 0;
                        $nomor = 1;
                    @endphp
                    @foreach ($cart_items as $item)
                    <tbody>
                    <tr>
                        @php
$product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
$img = App\Models\Product::where('id',$item->product_id)->value('product_img');
@endphp
<td><input type="checkbox" name="ids[{{$item->id}}]" class="checkbox_ids" id="" value="{{$item->id}}" ></td>
<td>{{ $nomor++ }}</td>
<td>{{$item->product_id}}</td>
                        <td><a href="{{route('singleproduct',[$item->product_id,$item->slug])}}"><img src="{{asset($img)}}" style="width: 50px; height:50px;"  alt=""></a></td>
                        <td>{{$product_name}}</td>
                        <td>
                            <div class="d-flex quantity-container">
                                <a href="{{ route('products.decrement', ['id' => $item->id]) }}" class="quantity-btn">-</a>
                                <p class="quantity-text">{{ $item->quantity }}</p>
                                <a href="{{ route('products.increment', ['id' => $item->id]) }}" class="quantity-btn">+</a>
                              </div>                       </td>
                        <td>{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                        @php
                            $total = $item->quantity * $item->price
                        @endphp
                        <td  class="item_price" data-price="{{ $total }}">{{'Rp '.number_format($total)}}</td>
                        <td>
                            <a href="{{route('deletecart',$item->id)}}" class="btn btn-warning me-2" id="delete_button">Hapus</a>

                        </td>
                    </tr>
                    @php
                        $total = $total + $item->price;
                    @endphp
                        @endforeach
                        @if ($total >0)
                    <tr>
                        <td>
                            <td></td>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Harga</td>
                        <td id="total_price">{{'Rp '.number_format(0)}}</td>
                        <td></td>
                        </tr>
                        <tr>
                            <td>
                                <td></td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                                <td colspan="7" class="d-flex">
                                    <input type="submit" class="btn btn-primary" value="Pesan Sekarang">
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                </form>
            </div>



            <div class="col-md-8">
                <section class="container col">
                  <section class="row">
                    <div class="col">
                      <h1 class="text-left" id="Profile">METODE PEMBAYARAN</h1>
                      <p class="teks">Silahkan pilih metode yang Anda inginkan</p>
                      <div class="col-md-10 shadow my-5 py-2">
                        <div class="accordion" id="accordionExample">
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button class="btn btn-block text-black dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  QRIS Mandiri
                                </button>
                              </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="text-center">
                                  <img src="{{ asset('img/qris.jpg')}}" class="img-fluid" alt="QRIS Mandiri">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </section>
              </div>


        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function calculateTotal() {
  var total = 0;
  $('.checkbox_ids:checked').each(function() {
    var price = parseFloat($(this).closest('tr').find('.item_price').data('price'));
    total += price;
  });

  if (total > 0) {
    var total_string = 'Rp ' + formatPrice(total);
    $('#total_price').text(total_string);
  } else {
    $('#total_price').text('Rp 0');
  }
}

function formatPrice(price) {
  var price_string = price.toFixed(0).toString();
  var formatted_price = '';
  var last_index = price_string.length - 1;

  for (var i = last_index; i >= 0; i--) {
    formatted_price = price_string[i] + formatted_price;
    var digit_index_from_right = last_index - i;
    if (digit_index_from_right % 3 == 2 && i > 0) {
      formatted_price = '.' + formatted_price;
    }
  }

  return formatted_price;
}

$(function() {
  // Checkbox all
  $('#select_all_ids').click(function() {
    $('.checkbox_ids').prop('checked', $(this).prop('checked'));
    calculateTotal();
  });

  $('.checkbox_ids').click(function() {
    calculateTotal();
  });
});

</script>
 <script>
        // Mendapatkan CSRF token dari meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Menambahkan CSRF token dalam setiap permintaan AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Skrip JavaScript lainnya
        // ...
    </script>

@push('js')

@endpush
@endsection
