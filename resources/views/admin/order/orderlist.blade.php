@extends('admin.layout.app')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                </div>


              {{-- search key  --}}
                {{-- <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key :<span class="text-danger"> {{ request('key') }}</span>
                        </h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('piza#list') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="search..."
                                    value={{ request('key') }}>
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
             <div class=" row ">
                <div class="d-flex mb-5 col-6">
               <form action="{{route('status#orderlsit')}}" method="get">
                @csrf
                <div class="d-flex">
                    <label for="" class=" mt-2  ">Order status</label>
                   <div class="d-flex">
                    <select id="orderstatus" name="status" class="  form-control">
                        <option value="">All</option>
                        <option value="0"  @if(request('status') == '0' )  selected @endif>Pending....</option>
                        <option value="1" @if(request('status') == '1' )    selected  @endif>Acept....</option>
                        <option value="2" @if(request('status') == '2' )  selected  @endif>Reject....</option>

                        </select>
                     <button type="submit" class="btn sm bg-dark text-white">Search</button>
                   </div>
                </div>
               </form>
                </div>

                <div class="col-6 ">
                    <div class="  col-md-2 offset-md-9  btn bg-white shadow-sm py-1 px-1 text-center ">
                         <i class="fa-solid fa-database me-2"></i> {{count($order)}}
                    </div>
                </div>
             </div>



               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Order Date </th>
                            <th>Order Code </th>
                            <th>Amount</th>
                            <th>status</th>

                        </tr>
                    </thead>
                    <tbody id="datalist" >
                        @foreach ($order as $o )
                        <tr class="tr-shadow">


                            <td> {{$o->user_id }}</td>
                            <td> {{$o->user_name }}
                              <input type="hidden" class="orderid" value="{{$o->id}}">
                            </td>
                            <td> {{ $o->created_at->format('F-j-Y') }} </td>
                            <td> <a href="{{route('list#info',$o->order_code )}}" class=" text-primary text-decoration-none "> {{$o->order_code }}</a></td>
                            <td> {{$o->total_price }} kyats </td>
                            <td>

                            <select name="status" class=" form-control statuschange">
                            <option value="0"  @if ($o->status == 0 ) selected @endif>Pending....</option>
                            <option value="1" @if ($o->status == 1 ) selected  @endif>Acept....</option>
                            <option value="2" @if ($o->status == 2 ) selected  @endif>Reject....</option>

                            </select>
                            </td>
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

@section('scriptSource')
 <script>
   $(document).ready(function() {
//     $('#orderstatus').change(function() {
//         $status = $('#orderstatus').val();


//         $.ajax({
//                type:'get',
//                url :'/admin/ajax/list',
//                data :{'status' : $status } ,
//              dataType: 'json',
//             success:function(response) {



//                 $ajaxlist = ' ';

//                   for($i=0;$i<response.length;$i++) {
//    $months = ['January','February','March','April','May','June','July','August','Setember','October','November','December'];
//    $dbdate = new Date(response[$i].created_at);
//    $finaldate = $months[$dbdate.getMonth()]+"-"+$dbdate.getDate()+"-"+$dbdate.getFullYear();

//        if(response[$i].status == 0 ) {
//         $statusMessage = `
//         <select name="status" class=" form-control statuschange">
//             <option value="0" selected>Pending....</option>
//             <option value="1" >Acept....</option>
//             <option value="2">Reject....</option>
//         </select>
//         `  }
//         else if(response[$i].status == 1 ) {
//         $statusMessage = `
//         <select name="status" class=" form-control statuschange">
//             <option value="0" selected>Pending....</option>
//             <option value="1" selected >Acept....</option>
//             <option value="2">Reject....</option
//         </select>
//         `  }
//         else if(response[$i].status == 2 ) {
//         $statusMessage = `
//         <select name="status" class=" form-control statuschange">
//             <option value="0" selected>Pending....</option>
//             <option value="1" >Acept....</option>
//             <option value="2" selected >Reject....</option>
//         </select>
//         `  }

//                 $ajaxlist += `

//                 <tr class="tr-shadow">


//                             <td> ${response[$i].user_id} </td>
//                             <td> ${response[$i].user_name} </td>
//                             <td> ${$finaldate} </td>
//                             <td> ${response[$i].order_code} </td>
//                             <td> ${response[$i].total_price } kyats </td>
//                             <td> ${$statusMessage} </td>
//                      </tr>
//                          `;       }

//              $('#datalist').html($ajaxlist);
//                                 } })




//     })
    //status change
    $('.statuschange').change(function () {
         $currentstatus = $(this).val();
         $parentNode = $(this).parents("tr");
        $orderid = $parentNode.find(".orderid").val();
        $data = {

              'orderid' : $orderid,
              'status'  : $currentstatus
        }
        $.ajax({
               type:'get',
               url :'/admin/status/change',
               data : $data ,
             dataType: 'json',
                })
         location.reload();
    })
   })
 </script>
@endsection
