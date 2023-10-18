@extends('user.layouts.master')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $c)
                    <tr>
                        <td><img src="{{ asset('storage/'.$c->image)}}" class="img-thumbnail shadow-sm" alt="" style="width:100px;height:60px"></td>
                        <td class="align-middle">{{ $c->pizza_name}}</td>
                        <td class="align-middle" id="price">{{ $c->pizza_price}} $</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->quantity}}" id="quantity">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id='total'>$ {{ $c->pizza_price*$c->quantity}} </td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Total Cart Fees</h6>
                        <h6 id="totalCartFee">$ {{ $totalPrice}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delievery Fees</h6>
                        <h6 class="font-weight-medium">$3</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="totalPrice">$ {{ $totalPrice + 3}}</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->




@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){

            //calc function
            $cartSummary = function(){
                //total cart fee
                $totalCartFee = 0
                $('#dataTable tbody tr').each(function(index,row){
                    $totalCartFee += Number($(row).find('#total').text().replace('$',''));
                })

                $('#totalCartFee').html('$' + $totalCartFee);

                //total
                $totalPrice = $totalCartFee + 3;
                $('#totalPrice').html('$' + $totalPrice);

            }

            //for + or - button click
            $('.btn-plus,.btn-minus').click(function(){
                $price = $(this).parents('tr').find('#price').text().replace('$','');
                $quantity = Number($(this).parents('tr').find('#quantity').val());
                $total = Number($price) * $quantity;

                $(this).parents('tr').find('#total').text("$" + $total);

                $cartSummary();

            });

            $('.btnRemove').click(function(){
                //cart remove
                $(this).parents('tr').remove();
                $cartSummary();
            })
        })
    </script>
@endsection
