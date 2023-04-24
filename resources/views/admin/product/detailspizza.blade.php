@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                         <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                    </div>



                                    <div class="row">
                                        <div class="col-4 offset-1 mt-1">

                                            <img src="{{asset('storage/'.$pizza->image)}}"  class=" img-thumbnail shadow-sm">

                                        </div>
                                        <div class="col-7 ">
                                          <div class="mb-3 btn bg-danger text-white d-block w-75 ">  {{ $pizza->name }}
                                         </div>

                                           <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-money-bill-wave"></i>
                                                {{ $pizza->price }} kysts  </span>

                                            <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-w"></i><i class="fa-solid fa-hourglass-half"></i>
                                                 {{ $pizza->waiting_time }} minutes </span>

                                            <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clone"></i>
                                                {{ $pizza->category_name }}  </span>

                                            <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-eye"></i>
                                                {{ $pizza->view_count }} view </span>

                                            <span class="my-3 btn bg-dark text-white"> <i class="fa-brands fa-creative-commons fa-s15 me-2"></i><i class="fa-solid fa-plus"></i>
                                                {{ $pizza->created_at->format('j-F-y') }}</span>

                                              <div class="my-3 "> <i class="fa-solid fa-circle-info "></i><i class="fa-regular fa-file-lines"></i> Details info </div>
                                              <div>  {{ $pizza->description }}</div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
