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
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Pizza product update</h3>
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                   </div>

                                    <form action="{{route('update#piza')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1 mt-5 ">
                                          <img src="{{asset('storage/'.$pizza->image)}}" >
                                                <div class=" mt-3">
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                        @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                </div>

                                                <div class=" mt-3">
                                                    <button class="btn btn-dark text-white submit col-12">
                                                        Update
                                                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right ml-2">
                                                        </i>

                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $pizza->id }}" name="pizzaId">
                                            <div class=" offset-1 col-6 ">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Product Name</label>
                                                    <input id="cc-pament" name="name" type="text" class=" form-control @error('name') is-invalid @enderror"
                                                    aria-required="true" value="{{old('name',$pizza->name)}}"  aria-invalid="false" placeholder="Seafood...">
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        <small style="color:red"> {{$message}} </small>
                                                     </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                  <select name="category" class="form-control @error('category') is-invalid @enderror">
                                                    <option value="">Choose your category </option>
                                                    @foreach ($category as $c)
                                                        <option value="{{$c->id}}" @if($pizza->category_id == $c->id) selected  @endif > {{$c->name}} </option>
                                                    @endforeach
                                                  </select>
                                                  @error('category')
                                                  <div class="invalid-feedback">
                                                      <small style="color:red"> {{$message}} </small>
                                                   </div>
                                                  @enderror
                                                 </div>

                                                 <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea name="description" placeholder="Enter your description" class="form-control @error('description') is-invalid @enderror" >{{old('description',$pizza->description )}}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        <small style="color:red"> {{$message}} </small>
                                                     </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="price" type="text" class=" form-control @error('price') is-invalid @enderror  "
                                                    aria-required="true" value="{{old('price',$pizza->price)}}"  aria-invalid="false" placeholder="product for price...">
                                                    @error('price')
                                                    <div class="invalid-feedback">
                                                        <small style="color:red"> {{$message}} </small>
                                                     </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">waitingTime for product</label>
                                                    <input id="cc-pament" name="waitingTime" type="number" class=" form-control @error('waitingTime') is-invalid @enderror "
                                                    aria-required="true" value="{{old('waitingTime',$pizza->waiting_time)}}"  aria-invalid="false" placeholder="product for waiting time...">
                                                    @error('waitingTime')
                                                    <div class="invalid-feedback">
                                                        <small style="color:red"> {{$message}} </small>
                                                     </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">View Count </label>
                                                    <input name="role" value={{ $pizza->view_count }}
                                                        type="text" class="form-control" aria-required="true"
                                                        aria-invalid="false" disabled>
                                                </div>



                                            </div>
                                        </div>
                                    </form>

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
