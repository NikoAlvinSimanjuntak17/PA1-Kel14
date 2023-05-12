@extends('users.layouts.templete')
@section('title','WijayaFarma | Add To Cart')
@section('css')
<style>
    .header{
        background-color:black;
        opacity: 0.8;
    }
</style>
@endsection
@section('main-content')
<div class="container">
<br><br><br><br><br><br><br><br>
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
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
                    <tr id="cart{{$item->id}}">
                        @php
$product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
$img = App\Models\Product::where('id',$item->product_id)->value('product_img');
@endphp
<td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{$item->id}}"></td>
<td>{{$item->id}}</td>
                        <td><img src="{{asset($img)}}" style="width: 50px; height:50px;"  alt=""></td>
                        <td>{{$product_name}}</td>
                        <td>
                        <form action="{{ route('items.update', $item->id) }}" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="number" name="quantity" min="0" value="{{ $item->quantity }}" class="form-control">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        </td>
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
                                <td>
                                    <a href="{{route('cart.delete')}}" id="deleteAllSelectedRecord" class="btn btn-warning">Remove</a>
                                    <a href="{{route('shippingaddress')}}" class="btn btn-primary" id="checkout_button">Checkout Now</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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

  // Checkbox individual
  $('.checkbox_ids').click(function() {
    calculateTotal();
  });
});

</script>
<script>
    $(function(e){
$('#select_all_ids').click(function(){
$('.checkbox_ids').prop('checked',$(this).prop('checked'));
});

$('#deleteAllSelectedRecord').click(function(e){
    e.preventDefault();
    var all_ids = [];
    $('input:checkbox[name=ids]:checked').each(function(){
        all_ids.push($(this).val());
    });
    $.ajax({
        url:"{{route('cart.delete')}}",
        type:"DELETE",
        data:{
            ids:all_ids,
            _token:'{{ csrf_token()}}'
        },
        success:function(response){
            $.each(all_ids,function(key,val){
                $('#cart'+val).remove();
            });
            location.reload();
        }
    });
});

$('#checkout_button').click(function(e){
    e.preventDefault();
    var selected_ids = [];
    $('input:checkbox[name=ids]:checked').each(function(){
        selected_ids.push($(this).val());
    });
    if (selected_ids.length > 0) {
        $.ajax({
            url:"{{route('cart.checkout')}}",
            type:"POST",
            data:{
                ids:selected_ids, // Mengirim hanya ids yang dipilih
                _token:'{{ csrf_token()}}'
            },
            success:function(response){
                // Jika checkout berhasil, arahkan ke halaman Shipping Address
                window.location.href = "{{route('shippingaddress')}}";
            }
        });
    } else {
        alert('Anda belum memilih item untuk checkout.');
    }
});


});

</script>
@endsection-
