@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
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
                    <div class="col-4">
                        <form action="{{ route('category#list')}}" method="GET" class="d-flex">
                            <input type="text" name="key" class="form-control" placeholder="Search ..." value="{{ request('key')}}">
                            <button class="btn bg-dark text-white" type="submit">
                                <i class="fa-solid fa-magnifying-glass" ></i>
                            </button>
                        </form>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row my-3" style="font-size: 18px;font-weight:800">
                    <div class="col-4 text-left">
                        Total : <span class="text-success">{{ $categories->total()}}</span>
                    </div>
                    <div class="col-4 offset-4 text-right">
                        Search Key : <span class="text-danger">{{ request('key')}}</span>
                    </div>
                </div>
                @if(session('createSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-regular fa-circle-check" style="color: #3c9a4f;"></i> {{ session('createSuccess')}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if(session('deleteSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-regular fa-circle-check" style="color: #e52323;"></i> {{ session('deleteSuccess')}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if(session('updateSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa-regular fa-circle-check" style="color: #3619b7;"></i> {{ session('updateSuccess')}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if(session('changePasswordSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-regular fa-circle-check" style="color: #d2c238;"></i> {{ session('changePasswordSuccess')}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif


                @if(count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr class="row  text-left">
                                <th class="col-2">ID</th>
                                <th class="col-4">Category Name</th>
                                <th class="col-3">Category Date</th>
                                <th class="col-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                            <tr class="tr-shadow row">
                                <td class="col-2">{{ $category->id}}</td>
                                <td class="col-4">{{ $category->name}}</td>
                                <td class="col-3">{{ $category->created_at->format('d-M-Y')}}</td>
                                <td class="col-3">
                                    <div class="table-data-feature">
                                        <a href="{{ route('category#edit',$category->id)}}" class="m-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a class="m-2" href="{{route('category#delete',$category->id)}}">
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
                        {{ $categories->appends(request()->query())->links()}}
                    </div>
                </div>
                @else
                <h4 class="text-center mt-4">There is no categories!</h4>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection


