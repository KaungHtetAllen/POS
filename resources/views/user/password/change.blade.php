@extends('user.layouts.master')

@section('content')
<div class="row">
    <div class="col-6 offset-3">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="#"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="">
                        <div class="card"style="border-radius: 20px">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <form action="{{ route('user#changePassword')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Old Password...">
                                        @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                        @if(session('notMatch'))
                                        <small class="text-danger">{{ session('notMatch')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your New Password...">
                                        @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                        @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg bg-dark text-white btn-block">
                                            <span id="payment-button-amount">Change Password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
