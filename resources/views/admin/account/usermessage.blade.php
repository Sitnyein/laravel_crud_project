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
                            <h2 class="title-1"> User response message </h2>

                        </div>
                    </div>
                </div>



                <div class="row mt-2">
                    <div class="col-2 offset-10 btn bg-white shadow-sm py-1 px-1 text-center ">
                         <i class="fa-solid fa-database me-2"></i> 22
                    </div>
                </div>



               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead >
                        <tr>
                            <th></th>
                             <th class=" col-1" >Name</th>
                             <th class=" col-1">Email</th>

                             <th class="col-8">Message</th>
                             <th class="col-2">Created_at</th>


                        </tr>
                    </thead>
                    <tbody >
                      @foreach ($contact as $c)
                      <tr class="tr-shadow">
                      <td></td>
                      <td class=" col-1"> {{$c->name}} </td>
                      <td class=" col-1"> {{$c->email}} </td>

                      <td> {{ $c->message}} </td>
                      <td>{{ $c->created_at->format('j-F-y') }}</td>
                      </tr>
                      @endforeach




                    </tbody>
                </table>

                <div class="mt-3">
                   {{ $contact->links() }}
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
