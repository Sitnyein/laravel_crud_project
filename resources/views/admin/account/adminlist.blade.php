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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                </div>
                @if(session('delete'))
                <!--alert message delete-->
                <div class='col-4 offset-8'>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key :<span class="text-danger"> {{ request('key') }}</span>
                        </h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('admin#list') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="search..."
                                    value= "{{ request('key') }}" >
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2 offset-10 btn bg-white shadow-sm py-1 px-1 text-center ">
                         <i class="fa-solid fa-database me-2"></i> {{$admins->total()}}
                    </div>
                </div>


               @if(count($admins) != 0)
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>address</th>
                            <th>Gender</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($admins as $admin )
                        <tr class="tr-shadow">
                        <td class="col-2 ">
                          @if ($admin->image == null)
                               @if ($admin->gender == 'male')
                               <img src="{{ asset('image/default_user.png') }}" class="shadow-sm">
                               @else <img src="{{asset('image/default_girl.png')}}" class="shadow-sm"> @endif
                         @else
                        <img src="{{ asset('storage/' . $admin->image) }}" />
                        @endif
                            {{-- <img src="{{asset('storage/'.$admin->image)}}"  class=" img-thumbnail shadow-sm">  --}}
                        </td>
                         <td class="col-2"> {{$admin->name}} </td>
                         <td  class="col-2"> {{$admin->email}} </td>
                         <td class="col-2" > {{$admin->phone}} </td>
                         <td  class="col-1">  {{$admin->address }}  </td>
                         <td class="col-1" > {{$admin->gender}} </td>
                         <td class="col-2">
                             <div class="table-data-feature">
                          @if ($admin->id == Auth::user()->id)
                         @else
                         <a href=" {{route('admin#delete',$admin->id)}} ">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                         </a>
                         <a href="{{route('change#row',$admin->id)}}">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Change Role">
                                <i class="fa-solid fa-person-walking"></i>
                            </button>
                        </a>
                          @endif

                             </div>
                         </td>
                     </tr>
                        @endforeach



                    </tbody>
                </table>

                <div class="mt-3">
                   {{ $admins->links() }}
                </div>
            </div>
               @else
               <h3 class = "text-center text-danger mt-3">The admin is no  here </h3>
               @endif

            </div>
        </div>
    </div>
</div>

@endsection
