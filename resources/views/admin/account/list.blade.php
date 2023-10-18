@extends('admin.layouts.master')

@section('title','Admin List Page')

@section('content')
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
                    <div class="col-4">
                        <form action="{{ route('admin#list')}}" method="GET" class="d-flex">
                            <input type="text" name="key" class="form-control" placeholder="Search ..." value="{{ request('key')}}">
                            <button class="btn bg-dark text-white" type="submit">
                                <i class="fa-solid fa-magnifying-glass" ></i>
                            </button>
                        </form>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add admin
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row my-3" style="font-size: 18px;font-weight:800">
                    <div class="col-4 text-left">
                        Total : <span class="text-success"></span>
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


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr class="row  text-left">
                                <th class="col-2">Image</th>
                                <th class="col-2"> Name</th>
                                <th class="col-3">Email</th>
                                <th class="col-2">Gender</th>
                                <th class="col-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($admins as $admin)
                            <tr class="tr-shadow row">
                                <td class="col-2">
                                    @if ($admin->image == null)
                                    <div class="w-100" style="display: flex;justify-content:center;align-items:center;border:1px solid rgba(0,0,0,0.3);box-shadow:1px 1px 1px rgba(0,0,0,0.3)">
                                        <img class="image w-100" src="{{ asset('image/default.jpg')}}" alt="" style="height:75px;">
                                    </div>
                                    @else
                                    <div class="w-100" style="display: flex;justify-content:center;align-items:center;border:1px solid rgba(0,0,0,0.3);box-shadow:1px 1px 1px rgba(0,0,0,0.3)">
                                        <img class="image w-100" src="{{ asset('storage/'.$admin->image)}}" alt="" style="height:75px;">
                                    </div>
                                    @endif

                                </td>
                                <td class="col-2">{{$admin->name}}</td>
                                <td class="col-3">{{ $admin->email}}</td>
                                <td class="col-2">{{ $admin->gender}}</td>
                                <td class="col-2 offset-1">
                                    <div class="table-data-feature">
                                        <a class="m-2" href="">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="zmdi zmdi-eye"></i>
                                            </button>
                                        </a>
                                        @if (Auth::user()->id != $admin->id)
                                        <a class="m-2" href="{{ route('admin#changeRolePage',$admin->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Role">
                                            <i class="fa-solid fa-screwdriver-wrench"></i>                                            </button>
                                        </a>
                                        <a class="m-2" href="{{ route('admin#delete',$admin->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
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
                        {{ $admins->appends(request()->query())->links()}}
                    </div>
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection


