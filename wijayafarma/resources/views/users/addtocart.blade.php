@extends('users.layouts.templete')
@section('title','WijayaFarma | Add To Cart')
@section('css')
<style>
    .header{
        background-color:black;
        opacity: 0.8;
    }
    .quantity-container {
  display: flex;
  align-items: center;
  background-size: contain;
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
                        <td>Product id</td>
                        <td>Product Image</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Count</td>
                    </tr>
                    </thead>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart_items as $item)
                    <tbody>
                    <tr>
                        @php
$product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
$img = App\Models\Product::where('id',$item->product_id)->value('product_img');
@endphp
<td><input type="checkbox" name="ids[{{$item->id}}]" class="checkbox_ids" id="" value="{{$item->id}}" ></td>
<td>{{$item->id}}</td>
                        <td><img src="{{asset($img)}}" style="width: 50px; height:50px;"  alt=""></td>
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
                        <td>Total</td>
                        <td id="total_price">{{'Rp '.number_format(0)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <td></td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                                <td colspan="7" class="d-flex">
                                    <a href="{{route('deletecart')}}" class="btn btn-warning me-2" id="delete_button">Delete</a>
                                    <input type="submit" class="btn btn-primary" id="checkout_button" value="Check Now">
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                </form>
            </div>

            <div class="col-md-8">
                <section class=" container col">
                    <section class="rowered_1">
                        <div class="row ">
                         <h1 class="text-left" id="Profile">METODE PEMBAYARAN</h1>
                         <p class="teks">Silahkan pilih metode yang anda inginkan</p>
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
                                        <center><img src="{{ asset('img/qris.jpg')}}"></center>
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
<script>
    $(function() {
  // Checkbox all
  $('#select_all_ids').click(function() {
    $('.checkbox_ids').prop('checked', $(this).prop('checked'));
    calculateTotal();
  });

  $('.checkbox_ids').click(function() {
    calculateTotal();
  });

  // Klik tombol Delete
  $('#delete_button').click(function(e) {
    e.preventDefault(); // Mencegah pengiriman form

    var checkedIds = [];

    $('.checkbox_ids:checked').each(function() {
      checkedIds.push($(this).val());
    });

    if (checkedIds.length === 0) {
      // Tidak ada checkbox yang dipilih, tampilkan peringatan atau lakukan tindakan yang sesuai
      return;
    }

    var confirmation = confirm('Apakah Anda yakin ingin menghapus item yang dipilih?');
    if (confirmation) {
      // Melakukan permintaan AJAX ke route deletecart
      $.ajax({
        url: '{{ route("deletecart") }}',
        method: 'POST',
        data: { ids: checkedIds },
        success: function(response) {
          // Menghandle respons sukses, misalnya menampilkan pesan sukses
          console.log(response);
          alert('Item berhasil dihapus');
          location.reload(); // Refresh halaman atau perbarui item keranjang
        },
        error: function(xhr, status, error) {
          // Menghandle respons error, misalnya menampilkan pesan error
          console.error(xhr.responseText);
          alert('Terjadi kesalahan saat menghapus item');
        }
      });
    }
  });
});

</script>

@push('js')

@endpush
@endsection
