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
                            <h2 class="title-1"> User List</h2>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key :<span class="text-danger"> {{ request('key') }}</span>
                        </h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('user#list') }}" method="get">
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
                         <i class="fa-solid fa-database me-2"></i> {{$users->total()}}
                    </div>
                </div>


               @if(count($users) != 0)
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
                            <th>Role</th>
                             <th></th>

                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($users as $user )
                        <tr class="tr-shadow">
                        <td class="col-2 ">
                          @if ($user->image == null)
                               @if ($user->gender == 'male')
                               <img src="{{ asset('image/default_user.png') }}" class="shadow-sm">
                               @else <img src="{{asset('image/default_girl.png')}}" class="shadow-sm"> @endif
                         @else
                        <img src="{{ asset('storage/' . $user->image) }}" class=" img-thumbnail shadow-sm" />
                        @endif
                        </td>
                         <td class="col-1"> {{$user->name}} <input type="hidden"  id="userid" value="{{$user->id}}"> </td>
                         <td  class="col-2"> {{$user->email}} </td>
                         <td class="col-2" > {{$user->phone}} </td>
                         <td  class="col-1">  {{$user->address }}  </td>
                         <td class="col-1" > {{$user->gender}} </td>
                         <td class="col-2">
                          <select name="" class=" form-control statuschange" id="">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                          </select>
                         </td>
                         <td class="col-2">   <a href="{{route('user#delete',$user->id)}} ">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                         </a></td>
                     </tr>
                        @endforeach



                    </tbody>
                </table>

                <div class="mt-3">
                   {{ $users->links() }}
                </div>
            </div>
               @else
               <h3 class = "text-center text-danger mt-3">The user is no  here </h3>
               @endif

            </div>
        </div>
    </div>
</div>

@endsection



@section('scriptSource')
 <script>
   $(document).ready(function() {

    //status change
    $('.statuschange').change(function () {
         $currentstatus = $(this).val();
         $parentNode = $(this).parents("tr");
         $userid = $parentNode.find("#userid").val();
         console.log($userid);
        $data = { 'userid' : $userid, 'role' : $currentstatus };

        $.ajax({
               type:'get',
               url :'/user/role/change',
               data : $data ,
             dataType: 'json',
                })
         location.reload();
    })
   })
 </script>
@endsection
