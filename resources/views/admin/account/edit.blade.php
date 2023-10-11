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
                            <h3 class="text-center title-2">Account Info Edit Page</h3>
                        </div>
                        <hr class="bg-dark">
                        <form action="{{ route('admin#update',Auth::user()->id)}}" class="mt-3" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-5 mr-3">
                                    <div class="image shadow-md my-2 form-group" style="display:flex;justify-content: center;align-item:center;">
                                         @if (Auth::user()->image == null)
                                         <div class="p-3 img-thumbnail" style="border-radius:10px;background-color:rgba(0,0,0,0.4)">
                                            <img src="{{ asset('image/default.jpg')}}" alt="default_user" style="width:200px">
                                         </div>
                                        @else
                                        <img src="{{ asset('storage/' . Auth::user()->image)}}" alt="{{ Auth::user()->id}}" />
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <input type="file" name="image" id="" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white form-control">Update<i class="fa-solid fa-circle-right ml-2"></i></button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name..." value="{{ old('name',Auth::user()->name)}}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email..."  value="{{ old('email',Auth::user()->email)}}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Your Gender</option>
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone..." value="{{ old('phone',Auth::user()->phone)}}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <input id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your address..." value="{{ old('address',Auth::user()->address)}}">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false"  value="{{ old('role',Auth::user()->role)}}" disabled >
                                        @error('role')
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


