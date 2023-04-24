@extends('admin.layout.app')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        {{-- main-create  --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-7">
                    <a href="{{route('piza#list')}}"><button class="btn bg-dark text-white mb-3">Product List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Product create</h3>
                        </div>
                        <hr>
                        <form action="{{route('create#Piza')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Product Name</label>
                                <input id="cc-pament" name="name" type="text" class=" form-control @error('name') is-invalid @enderror"
                                aria-required="true"   aria-invalid="false" placeholder="Seafood...">
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
                                    <option value="{{$c->id}}"> {{$c->name}} </option>
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
                                <textarea name="description" placeholder="Enter your description" class="form-control @error('description') is-invalid @enderror" > </textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    <small style="color:red"> {{$message}} </small>
                                 </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="invalid-feedback">
                                    <small style="color:red"> {{$message}} </small>
                                 </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="text" class=" form-control @error('price') is-invalid @enderror  "
                                aria-required="true"   aria-invalid="false" placeholder="product for price...">
                                @error('price')
                                <div class="invalid-feedback">
                                    <small style="color:red"> {{$message}} </small>
                                 </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">waitingTime for product</label>
                                <input id="cc-pament" name="waitingTime" type="number" class=" form-control @error('waitingTime') is-invalid @enderror "
                                aria-required="true"   aria-invalid="false" placeholder="product for waiting time...">
                                @error('waitingTime')
                                <div class="invalid-feedback">
                                    <small style="color:red"> {{$message}} </small>
                                 </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>

                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
