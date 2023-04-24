@extends('user.layout.master')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by catgories</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" d-flex align-items-center justify-content-between  mb-3 bg-dark text-white px-3 py-1">
                        <label for="" class=" mt-2"> Categories </label>
                        <span class=" badge border font-weight-normal">{{ count($category )}}</span>
                    </div>
                    <hr>
                    <div class=" d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('customer#home')}}" class="text-dark">  <label for="price"> All </label></a>
                     </div>
                    @foreach ($category as $c )
                   <div class=" d-flex align-items-center justify-content-between mb-3">
                       <a href="{{route('category#filter', $c->id )}}" class="text-dark">  <label for="price"> {{ $c->name }} || {{$c->id}} </label></a>
                    </div>
                        @endforeach
                 </form>
            </div>

            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>

        </div>
      <!-- Shop Product Start -->
      <div class="col-lg-9 col-md-8">
        <div class="row pb-3">
            <div class="col-12 pb-1">
                <div class="d-flex align-items-center justify-content-between mb-4 ml-5">
                    <div>
                    {{-- order list for cart  --}}
                       <a href="{{route('cart#list')}}">
                        <button type="button" class="btn btn-dark text-white position-relative">
                            <i class="fa-solid fa-cart-plus"></i>
                           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($cart) }}
                        </span>
                         </button>
                       </a>
                       <a href="{{route('cart#history')}}" class="ml-3">
                        <button type="button" class="btn btn-dark text-white position-relative">
                            <i class="fa-solid fa-clock-rotate-left"></i>  History
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count($history) }}
                            </span>
                        </button>
                       </a>
                    </div>
                     {{-- history cart  --}}

                    <div class="ml-2">
                        <div class="btn-group">
                          <select name="sorting" id="sortingOption" class=" form-control">
                            <option value="">Choose option </option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                          </select>
                        </div>

                    </div>
                </div>
            </div>
       <span class="row" id="datalist">
        @foreach ($pizza as $p )
        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
         <div class="product-item bg-light mb-4">
             <div class="product-img position-relative overflow-hidden">
                 <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image )}}" alt="">
                 <div class="product-action" >
                     {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
                     <a class="btn btn-outline-dark btn-square" id="click" href="{{route('pizza#deatails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                 </div>
             </div>
             <div class="text-center py-4">
                 <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                 <div class="d-flex align-items-center justify-content-center mt-2">
                     <h5>{{$p->price}}</h5>
                 </div>
                 {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                     <small class="fa fa-star text-primary mr-1"></small>
                     <small class="fa fa-star text-primary mr-1"></small>
                     <small class="fa fa-star text-primary mr-1"></small>
                     <small class="fa fa-star text-primary mr-1"></small>
                     <small class="fa fa-star text-primary mr-1"></small>
                 </div> --}}
             </div>
         </div>
     </div>
         @endforeach
       </span>


        </div>
    </div>
    <!-- Shop Product End -->
</div>
</div>
<!-- Shop End -->

@endsection


{{-- js code juery code  --}}
@section('scriptSource')
    <script>
   $(document).ready(function(){

     $('#sortingOption').change(function () {
          $eventOption = $('#sortingOption').val();
           console.log($eventOption);

       if($eventOption == 'asc')
         {
             $.ajax({
                type:'get',
               url :'http://localhost:8000/user/ajax/pizzalist',
               data : {'status' : 'asc'},
             dataType: 'json',
         success:function(response) {
                   $list = ' ';
                  for($i=0;$i<response.length;$i++) {
                $list += `   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image} ')}}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price}</h5>
                    </div>
                </div>
            </div>
           </div>`;       }
             $('#datalist').html($list);

                                } })
         }

      else if ($eventOption == 'desc')
         {
              $.ajax({
               type:'get',
               url :'http://localhost:8000/user/ajax/pizzalist',
               data : {'status' : 'desc'},
             dataType: 'json',
            success:function(response) {
                $list = ' ';
                  for($i=0;$i<response.length;$i++) {
                $list += `   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image} ')}}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price}</h5>
                    </div>
                </div>
            </div>
           </div>`;       }
             $('#datalist').html($list);
                                } })
         }


   })









   });

    </script>
@endsection
