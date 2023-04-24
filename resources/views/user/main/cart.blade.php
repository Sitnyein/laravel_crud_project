@extends('user.layout.master')
@section('content')

<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      @foreach ($cartlist as $c )
                      <tr>
                        {{-- <input type="hidden" id="price" value="{{ $c->pizza_price }} "> --}}
                        <td class="align-middle col-2"><img src="{{asset('storage/'.$c->product_image )}}" alt="" style="width: 100px;">
                            {{ $c->pizza_name }}
                         <input type="hidden" class="userid" value="{{$c->user_id}}">
                         <input type="hidden" class="orderid" value="{{$c->id}}">
                         <input type="hidden" class="productid" value="{{$c->product_id}}">

                            </td>
                        <td class="align-middle" id="price"> {{ $c->pizza_price }}  </td>
                        <td class="align-middle">

                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty" value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle col-2" id="total"> {{$c->pizza_price * $c->qty}} kyats </td>
                        <td class="align-middle btnremove"><button class="btn btn-sm btn-danger "><i class="fa fa-times"></i></button></td>
                    </tr>

                      @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalprice}} kyats </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium"> 3000 kyats </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice"> {{ $totalprice + 3000  }} kyats </h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            Proceed To Checkout</button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="removeBtn">
                                Proceed To remove</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->




@endsection



{{-- js code juery code  --}}
@section('scriptSource')
<script>
    // start product increase or decrease js code
$(document).ready(function(){
   $('.btn-plus').click(function () {
    $parentNode = $(this).parents("tr");
    $price  = Number($parentNode.find('#price').text().replace("kyats",""));
   $qty  = Number($parentNode.find('#qty').val());
   $totalprice = $price * $qty;
   $parentNode.find('#total').html($totalprice +"kyats");
   summaryCaculation()
  });

   $('.btn-minus').click(function () {
    $parentNode = $(this).parents("tr");
    $price  = Number($parentNode.find('#price').text().replace("kyats",""));
   $qty  = Number($parentNode.find('#qty').val());
   $totalprice = $price * $qty;
   $parentNode.find('#total').html($totalprice +"kyats");
   summaryCaculation()

});



   function summaryCaculation()
   {
     $totalPrice = 0;
     $('#dataTable tr').each(function(index,row){
        $totalPrice += Number($(row).find('#total').text().replace("kyats",""));
     });
     $("#subTotalPrice").html(`${$totalPrice} kyats`);
     $("#finalPrice").html(`${$totalPrice+3000} kyats`);
   }
//   end  product increase or decrease js code
 ///////////////////////////////////////////
//start cart is add to orderlist jscode
$('#orderBtn').click(function () {

    $orderlist = [];
    $random = Math.floor(Math.random() * 10000001);
    $('#dataTable tbody tr').each(function(index,row){
          $orderlist.push({
            'userid' :$(row).find('.userid').val(),
          'productid' :$(row).find('.productid').val(),
           'qty'      :$(row).find('#qty').val(),
           'total'    :$(row).find('#total').text().replace('kyats','')*1,
        'ordercode'   :'POS'+$random
           });
   });

   $.ajax({
               type:'get',
               url :'http://localhost:8000/user/ajax/order',
               data : Object.assign({},$orderlist),
             dataType: 'json',
            success:function(response) {
                if(response.status == "true") {
             window.location.href= "http://localhost:8000/user/home"; }
                                } })

})

////////////////////////////////////////////////////////////////////////
//remove btn proceed
$('#removeBtn').click(function() {

     $.ajax({
               type:'get',
               url :'http://localhost:8000/user/ajax/clearcart',
             dataType: 'json', })
     $('#dataTable tbody tr').remove();
     $("#subTotalPrice").html("0kyats");
     $("#finalPrice").html(`3000 kyats`);
  })


 //remove current product
  $('.btnremove').click(function () {
     $parentNode = $(this).parents("tr");
     $productid = $parentNode.find(".productid").val();
     $orderid = $parentNode.find(".orderid").val();
     $.ajax({
               type:'get',
               url :'http://localhost:8000/user/ajax/clear/ordercart',
               data : {'productid' : $productid ,'orderid' : $orderid},
             dataType: 'json',
              })
     $parentNode.remove();
     summaryCaculation();

});



















});

</script>
@endsection
