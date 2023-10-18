@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('products#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <div class="" style="cursor: pointer">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info Edit Page</h3>
                        </div>
                        <hr class="bg-dark">
                        <form action="{{ route('products#update')}}" class="mt-3" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-5 mr-3">
                                    <div class="image shadow-md my-2 form-group" style="display:flex;justify-content: center;align-item:center;">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="{{ $product->id}}" />
                                    </div>
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white form-control">Update<i class="fa-solid fa-circle-right ml-2"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" name="productId" value="{{$product->id}}">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name..." value="{{ old('name',$product->name)}}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="category" class="form-control @error('category') is-invalid @enderror">
                                            <option value="">Choose Your Category ... </option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if ($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="description" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror" value="" aria-required="true" aria-invalid="false" placeholder="Enter Your Description..." >{{ old('description',$product->description)}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                       <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$product->price)}}" aria-required="true" aria-invalid="false" placeholder="Enter Price..." >
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="waitingTime" type="text" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your waitingTime..." value="{{ old('waitingTime',$product->waiting_time)}}">
                                        @error('waitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" type="text" class="form-control @error('viewCount') is-invalid @enderror" aria-required="true" aria-invalid="false"  value="{{ old('viewCount',$product->view_count)}}" disabled >
                                        @error('viewCount')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                        <input id="cc-pament" name="createDate" type="text" class="form-control @error('createDate') is-invalid @enderror" aria-required="true" aria-invalid="false"  value="{{ old('createDate',$product->created_at->format('d-M-Y'))}}" disabled >
                                        @error('createDate')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
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
@endsection


