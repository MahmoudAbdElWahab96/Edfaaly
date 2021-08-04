@extends('site.layouts.master')

@section('page-content')


<div class="page-content">
    <div class="container-fluid">
        <div class="main-widget">
            <div class="main-widget-title">
                <h3>Our Products</h3>
            </div>
            <!--End main-widget-title-->
            <div class="main-widget-cont">
                <div class="widgets_carousel5">

                    @foreach($products as $product)
                        <div class="product-item">
                            <div class="img-container">
                                <a href="#" class="product-img">
                                    <img src=""
                                        style="height: 200px" alt="">
                                </a>
                                <div class="product-action">
                                    <a href="#" class="add-to-cart-btn" data-id="{{$product->id}}"
                                        data-url="{{route('site.cart.addToCart')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <!--End product-action-->
                            </div>
                            <!--End img-container-->
                            <div class="product-desc">
                                <a href="#" class="product-name">
                                    {{$product->name}}
                                </a>
                                <!--End product-name-->
                                <div class="price-box" style="margin-top: 5px;">
                                    <span class="price">
                                        $ {{$product->price}}
                                    </span>
                                </div>
                                <!--End price-box-->
                            </div>
                            <!--End product-desc-->
                        </div>
                        <!--End product-item-->
                    @endforeach
                </div>
                <!--End widgets_carousel5-->
            </div>
            <!--End main-widget-cont-->
        </div>
        <!--End main-widget-->
    </div>
    <!--End container-fluid-->
</div>
<!--End page-content-->


@section ('scripts')

<script>
$(document).on('click', '.add-to-cart-btn', function(e) {

    e.preventDefault();

    var _this = $(this);
    var product_id = _this.data('id');
    var type = _this.data('type');
    var pov = _this.data('pov');
    var quantity = 1;
    var url = _this.data('url');
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            product_id: product_id,
            type: type,
            pov: pov,
            quantity: quantity
        },
        success: function(result) {
            $.toast({
                heading: 'Information',
                text: 'product was added to cart successfully!',
                icon: 'info',
                loader: true, // Change it to false to disable loader
                loaderBg: '#E3363F' // To change the background
            });
            console.log(result)
        }

    });

});
</script>

@endsection

@endsection