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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('piza#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
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
                        <form action="{{ route('piza#list') }}" method="get">
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="search..."
                                    value={{ request('key') }}>
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2 offset-10 btn bg-white shadow-sm py-1 px-1 text-center ">
                         <i class="fa-solid fa-database me-2"></i> {{$piza->total()}}
                    </div>
                </div>


               @if(count($piza) != 0)
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>View count</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($piza as $p )
                        <tr class="tr-shadow">

                         <td class="col-2 "> <img src="{{asset('storage/'.$p->image)}}"  class=" img-thumbnail shadow-sm"> </td>
                         <td class="col-2"> {{$p->name}} </td>
                         <td  class="col-2"> {{$p->price}} </td>
                         <td class="col-2" > {{$p->category_name}} </td>
                         <td  class="col-1"> <i class="fa-solid fa-eye"></i> {{$p->view_count }}  </td>
                         <td class="col-2">
                             <div class="table-data-feature">

                             <a href="{{route('edit#pagepizza',$p->id)}}">
                                 <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                     <i class="zmdi zmdi-edit"></i>
                                 </button>
                             </a>
                             <a href="{{route('details#pizza',$p->id)}}">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                    <i class="fa-solid fa-expand"></i>
                                </button>
                            </a>
                            <a href="{{route('delete#pizza',$p->id)}}">
                                 <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                     <i class="zmdi zmdi-delete"></i>
                                 </button>
                              </a>

                             </div>
                         </td>
                     </tr>
                        @endforeach



                    </tbody>
                </table>

                <div class="mt-3">
                   {{ $piza->links() }}
                </div>
            </div>
               @else
               <h3 class = "text-center text-danger mt-3">There is no category here </h3>
               @endif

            </div>
        </div>
    </div>
</div>

@endsection
