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
                                        <h3 class="text-center title-2">Admin Profile edit</h3>
                                    </div>

                                    <hr>
                                    <form action="{{ route('acc#update', Auth::user()->id) }} " method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1 mt-3">
                                                @if (Auth::user()->image == null)
                                                     @if (Auth::user()->gender == 'male')
                                                     <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm">
                                                     @else <img src="{{asset('image/default_girl.png')}}" class="img-thumbnail shadow-sm"> @endif
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail shadow-sm">
                                                @endif
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

                                            <div class="  col-4 offset-1">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input type="text"  name="Name" value= "{{ old('Name', Auth::user()->name) }} "
                                                class="form-control @error('Name') is-invalid @enderror" placeholder="Enter Admin Name...">
                                                    @error('Name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input name="email" value= "{{ old('email', Auth::user()->email) }} "
                                                        type="email"
                                                        class="form-control @error('email') is-invalid  @enderror "
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Email...">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                                        type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        placeholder="Enter Admin phone...">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">address</label>
                                                    <textarea name="address" placeholder="Enter Admin address" class="form-control @error('address') is-invalid  @enderror">{{ old('address', Auth::user()->address) }}
                                                    </textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="male"
                                                            @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                        <option value="female"
                                                            @if (Auth::user()->gender == 'female') selected @endif>Female
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input name="role" value={{ old('role', Auth::user()->role) }}
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


@endsection
