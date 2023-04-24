@extends('admin.layout.app')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
         <div class="table-responsive table-responsive-data2">
            <div class="mx-5 mb-3">
                  <a href="{{route('adminOrder#list')}}" class=" text-dark text-decoration-none">  <i class="fa-solid fa-arrow-left "></i>Back</a>
           </div>
           <div class="row col-5">
            <div class="card mt-4">
            <div class="card-body">
                <h3>Order info </h3>
                <small class=" text-warning">Include delivery charges </small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col"> <i class="fa-solid fa-user"></i>  Customer Name </div>
                    <div class="col"> {{strtoupper($orderlist[0]->user_name)}} </div>
                </div>
                <div class="row">
                    <div class="col"> <i class="fa-solid fa-barcode"></i>  Order Code </div>
                    <div class="col"> {{$orderlist[0]->order_code}} </div>
                </div>
                <div class="row">
                    <div class="col"> <i class="fa-regular fa-clock"></i> Order Date  </div>
                    <div class="col"> {{$orderlist[0]->created_at->format('F-j-Y')}} </div>
                </div>
                <div class="row">
                    <div class="col"><i class="fa-solid fa-money-bill-wave"></i>  Total  </div>
                    <div class="col"> {{$order->total_price}} kyats </div>
                </div>
            </div>
            </div>
           </div>

                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Order Id</th>
                            <th>Product Image </th>
                            <th>Product Name </th>
                            <th>Qty</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody id="datalist" >
                        @foreach ($orderlist as $o )
                        <tr class="tr-shadow">


                            <td> </td>
                            <td> {{$o->id }} </td>
                            <td class="col-2"> <img src="{{asset('storage/'.$o->product_image)}}" class=" img-thumbnail" alt="">  </td>
                            <td> {{$o->product_name}} </td>
                            <td> {{$o->qty }} </td>
                            <td>{{$o->total}}</td>
                     </tr>
                        @endforeach



                    </tbody>
                </table>

                <div class="mt-3">
                   {{-- {{ $order->links() }}   --}}
                </div>
            </div>


            </div>
        </div>
    </div>
</div>

@endsection

