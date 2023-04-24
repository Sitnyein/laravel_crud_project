
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
                                    <form action="{{ route('row#update', $account->id) }} " method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1 mt-5">
                                                @if ($account->image == null)
                                                     @if ($account->gender == 'male')
                                                     <img src="{{ asset('image/default_user.png') }}" class="shadow-sm">
                                                     @else <img src="{{asset('image/default_girl.png')}}" class="shadow-sm"> @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $account->image) }}" />
                                                @endif


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
                                                    <input type="text"  name="Name" disabled value= "{{  $account->name }} "
                                                class="form-control " placeholder="Enter Admin Name...">


                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input name="email" disabled value= "{{ $account->email }} "
                                                        type="email"
                                                        class="form-control  "
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Email...">

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input name="phone" disabled value="{{  $account->phone }}"
                                                        type="text"
                                                        class="form-control "
                                                        placeholder="Enter Admin phone...">

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">address</label>
                                                    <textarea name="address" disabled placeholder="Enter Admin address" class="form-control">{{  $account->address }}
                                                    </textarea>


                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender"  disabled class="form-control">
                                                        <option value="male"
                                                            @if ($account->gender == 'male') selected @endif>Male</option>
                                                        <option value="female"
                                                            @if ($account->gender == 'female') selected @endif>Female
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="admin"
                                                            @if ($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"
                                                            @if ($account->role == 'user') selected @endif>User
                                                        </option>

                                                    </select>

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
