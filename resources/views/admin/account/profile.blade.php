@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            @if(session('updateSuccess'))
                            <div class="col-5 offset-7">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check" style="color: #3619b7;"></i> {{ session('updateSuccess')}}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-3 offset-1 mr-3">
                                <div class="image shadow-md" style="width:200px;height:200px;border-radius:50%">
                                     @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/default.jpg')}}" alt="default_user">
                                    @else
                                    <img src="{{ asset('storage/'. Auth::user()->image) }}" alt="{{ Auth::user()->id}}" style="width:200px;height:200px;border-radius:50%;box-shadow:0 0 5px rgba(0,0,0,0.3)" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class="">
                                    <h4 class="my-1"><i class="fa-solid fa-user mr-2"></i>{{ Auth::user()->name}}</h4>
                                    <h4 class="my-1"><i class="fa-solid fa-envelope mr-2"></i>{{ Auth::user()->email}}</h4>
                                    <h4 class="my-1"><i class="fa-solid fa-venus-mars mr-2"></i>{{ Auth::user()->gender}}</h4>
                                    <h4 class="my-1"><i class="fa-solid fa-phone mr-2"></i>{{ Auth::user()->phone}}</h4>
                                    <h4 class="my-1"><i class="fa-solid fa-location-dot mr-2"></i>{{ Auth::user()->address}}</h4>
                                    <h4 class="my-1"><i class="fa-solid fa-clock mr-2"></i>{{ Auth::user()->created_at->format('d-M-Y')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 offset-5">
                                <a href="{{ route('admin#edit')}}">
                                    <button class="btn bg-dark text-white"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


