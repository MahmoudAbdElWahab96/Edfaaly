@extends('site.layouts.master')

@section('page-content')

    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">{{count($products)}} items</div>
                    </div>
                </div>

                @if(count($products) > 0)
                    @foreach($products as $key => $item)
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="#"></div>
                                <div class="col">
                                    <div class="row text-muted">{{ $item->name }} [{{ $item->model_number}}]</div>
                                </div>
                                <div class="col">&euro; {{ $item->price }} <span class="close">&#10005;</span></div>
                            </div>
                            <div class="product-remove"
                                data-url="{{route('site.cart.removeItem', ['index' => $key])}}"
                                data-index="{{$key}}">
                                <i class="fa fa-close"></i>
                            </div><!-- .product-remove -->
                        </div>
                    @endforeach
                @else
                    <span> No Items</span>
                @endif
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS {{ count($products)}}</div></br>
                    <div class="col text-left">Subtotal:
                        <div class="col text-right">&dollar; {{ ROUND($total_cost,2) }}</div>
                    </div>
                    <div class="col text-left">Taxes:
                        <div class="col text-right">&dollar; {{ ROUND($total_tax,2) }}</div>
                    </div>

                    @if($values_discunts != 0))
                        <div class="col text-left">Discounts:
                            @foreach($discounts as $key => $value)
                                <div class="col text-right"> {{ $key }} &dollar; {{ ROUND($value,3) }} </div>
                            @endforeach
                        </div>
                    @endif

                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&dollar; {{ $total_costs }}</div>
                </div> <button class="btn">CHECKOUT</button>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<style>
    .title {
        margin-bottom: 5vh
    }

    .card {
        margin: auto;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 1rem;
        border: transparent
    }

    @media(max-width:767px) {
        .card {
            margin: 3vh auto
        }
    }

    .cart {
        background-color: #fff;
        padding: 4vh 5vh;
        border-bottom-left-radius: 1rem;
        border-top-left-radius: 1rem
    }

    @media(max-width:767px) {
        .cart {
            padding: 4vh;
            border-bottom-left-radius: unset;
            border-top-right-radius: 1rem
        }
    }

    .summary {
        background-color: #ddd;
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        padding: 4vh;
        color: rgb(65, 65, 65)
    }

    @media(max-width:767px) {
        .summary {
            border-top-right-radius: unset;
            border-bottom-left-radius: 1rem
        }
    }

    .summary .col-2 {
        padding: 0
    }

    .summary .col-10 {
        padding: 0
    }

    .row {
        margin: 0
    }

    .title b {
        font-size: 1.5rem
    }

    .main {
        margin: 0;
        padding: 2vh 0;
        width: 100%
    }

    .col-2,
    .col {
        padding: 0 1vh
    }

    a {
        padding: 0 1vh
    }

    .close {
        margin-left: auto;
        font-size: 0.7rem
    }

    img {
        width: 15.5rem
    }

    .back-to-shop {
        margin-top: 4.5rem
    }

    h5 {
        margin-top: 4vh
    }

    hr {
        margin-top: 1.25rem
    }

    form {
        padding: 2vh 0
    }

    select {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1.5vh 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247)
    }

    input {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247)
    }

    input:focus::-webkit-input-placeholder {
        color: transparent
    }

    .btn {
        background-color: #000;
        border-color: #000;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        margin-top: 4vh;
        padding: 1vh;
        border-radius: 0
    }

    .btn:focus {
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none
    }

    .btn:hover {
        color: white
    }

    a {
        color: black
    }

    a:hover {
        color: black;
        text-decoration: none
    }

    #code {
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center
    }
    </style>
@endsection