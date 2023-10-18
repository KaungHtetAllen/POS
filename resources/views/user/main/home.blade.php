
@extends('user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
            <div class="bg-light p-4 mb-30">
                <form class="">
                    <div class=" d-flex align-items-center justify-content-between mb-3">
                        <label class="text-dark" for="price-all" style="font-weight: 500;font-size:18px">Categories</label>
                        <span class="">{{ count($categories)}}</span>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between mb-3" style="cursor: pointer">
                        <a href="{{ route('user#home')}}" class="text-dark" style="text-decoration: none">
                            All
                        </a>
                    </div>
                    @foreach ($categories as $category)
                    <div class="d-flex align-items-center justify-content-between mb-3" style="cursor: pointer">
                        <a href="{{ route('user#filter',$category->id)}}" class="text-dark" style="text-decoration: none">
                            {{ $category->name}}
                        </a>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->

            {{ $categories->appends(request()->query())->links()}}
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user#cartList')}}">
                                <button type="button" class="btn btn-dark">
                                    <i class="fa-solid fa-cart-shopping mr-2"></i>
                                    {{ count($carts)}}
                                </button>
                            </a>

                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control btn bg-dark text-white">
                                    <option value="">Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                   <div class="row" id="dataList">
                     @if (count($products) != 0)
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1"id="myForm">
                        <div class="product-item bg-light mb-4" >
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image)}}" alt="" style="height: 300px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$product->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $product->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $product->price}} $</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                     @else
                     <div class="row mt-5">
                        <div class="col-6 offset-3 text-center">
                            <p style="font-size:20px;font-weight:500">There is pizza!</p>
                        </div>
                     </div>
                     @endif
                   </div>
                <h1 hidden>{{ $categories->appends(request()->query())->links()}}</h1>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();

                if($eventOption == 'asc'){
                    $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/user/ajax/pizzaList',
                        dataType:'json',
                        data:{'status':'asc'},
                        success:function(response){
                            $list = ``;
                            for (let $i = 0; $i < response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="" style="height: 300px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    })
                }
                else if($eventOption == 'desc'){
                    $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/user/ajax/pizzaList',
                        dataType:'json',
                        data:{'status':'desc'},
                        success:function(response){
                        $list = ``;
                        for (let $i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="" style="height: 300px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        $('#dataList').html($list);                        }
                    })
                }
            });
        });
    </script>
@endsection
