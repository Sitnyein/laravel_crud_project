@extends('admin.layout.app')
@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        {{-- main-create  --}}
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Category Update</h3>
                        </div>
                        <hr>
                        <form action="{{route('category#update')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="editId" value="{{$category->id}}">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="CategoryName" type="text" class=" form-control @error('CategoryName') is-invalid @enderror "
                                aria-required="true"  value="{{ old('CategoryName',$category->name )}}" aria-invalid="false" placeholder="Seafood...">
                                @error('CategoryName')
                                <div class="invalid-feedback">
                                    <small style="color:red"> {{$message}} </small>
                                 </div>
                                @enderror
                            </div>



                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end create  --}}
        </div>
    </div>
</div>

@endsection
