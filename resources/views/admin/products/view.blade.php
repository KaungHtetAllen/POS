@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-8 text-center">
                    <a href="{{ route('products#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="cursor: pointer">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Product Info</h3>
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
                                    <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->id}}" style="width:200px;height:200px;box-shadow:0 0 5px rgba(0,0,0,0.3)" />
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class="">
                                    <h4 class="mb-3 btn btn-primary d-block" style="text-transform:uppercase;font-weight:700">{{ $product->name}}</h4>
                                    <span class="my-1 btn bg-dark text-white"><i class="fa-solid fa-pizza-slice mr-2"></i>{{ $product->category_name}}</span>
                                    <span class="my-1 btn bg-dark text-white"><i class="fa-solid fa-money-check-dollar mr-2"></i>{{ $product->price}}</span>
                                    <span class="my-1 btn bg-dark text-white"><i class="fa-solid fa-stopwatch mr-2"></i>{{ $product->waiting_time}}</span>
                                    <span class="my-1 btn bg-dark text-white"><i class="fa-solid fa-eye mr-2"></i>{{ $product->view_count}}</span>
                                    <span class="my-1 btn bg-dark text-white"><i class="fa-solid fa-calendar-days mr-2"></i>{{ $product->created_at->format('d-M-Y')}}</span>
                                    <h4 class="my-3"><i class="fa-solid fa-file mr-2"></i>{{ $product->description}}</h4>
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


