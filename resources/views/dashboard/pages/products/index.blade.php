@extends('dashboard.layouts.master')
@section('content')

<style>
.modal .modal-header {
    color: #fff;
    background: #032524
}

.modal .modal-header button {
    background: #8bc340;
    background: #8bc340;
    padding: 1px 6px;
    border-radius: 5px;
    opacity: 0.75;
    transition: ease-in-out all 0.3s;
}

.modal .modal-body {
    padding: 35px 15px;
}

.modal .form-action {
    background: #032524;
}


.modal .form-action .button-add,
.modal .form-action .button-update {
    padding: 5px 25px;
    border-radius: 4px;
    background: #8bc340;
    color: #fff;
    border: none;
    transition: all ease-in-out .3s;
}

.modal .form-action .button-update:hover,
.modal .form-action .button-add:hover {
    background: #3c763d;
}
</style>
<section class="content-header">
    <h1>
        Dashboard
        <small>Products</small>
    </h1>
</section>

<div class="box box-primary">
    <div class="box-header">
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip"
                title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
        </div>
        <i class="fa fa-tasks"></i>
        <h3 class="box-title">Products <small class="badge bg-green"></small></h3>
        <div class="panel-body">
            <a href="{{  route('dashboard.products.getCreateNewProduct')}}" class="btn btn-primary btn-sm" style="float: right;">
                <li class="fa fa-plus"> Add product</li>
            </a>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($products->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Model Number</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                            </tr>
                            <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <td>{{ $product->model_number }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2>No Records</h2>
                    @endif
                </div><!-- /.box-body -->
        </div>

</div><!-- /.box -->

@stop