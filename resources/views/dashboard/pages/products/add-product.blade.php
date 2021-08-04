@extends('dashboard.layouts.master')
@section('content-header')
    <section class="content-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><h4>Products</h4></li>
                <li class="breadcrumb-item"><a href="{{  route('dashboard.products.getIndex')  }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{  route('dashboard.products.getCreateNewProduct')  }}">Add Products</a></li>
            </ol>
        </nav>
    </section>
@endsection

@section('content')

    <!-- start section  -->
    <section class="content">

        <!-- start panel-primary div -->
        <div class="panel panel-primary">

            <!-- Default panel contents -->
            <div class="panel-heading" style="font-size: large">Add Product</div>

            <!-- start form submited -->
            <form action="{{ route('dashboard.products.createNewProduct') }}"  method="post"
                  class="add-form">

                {!! csrf_field() !!}

                <!-- start class panel -->
                <div class="panel-body">
                @include('dashboard.partials._errors')

                    <!-- start name en & ar labels div row -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name" class="col-2 col-form-label ">Name</label>
                            <input class="form-control required" type="text" id="name" name="name"
                                placeholder="name">
                        </div>
                   
                        <div class="form-group col-sm-6">
                            <div class="col-10">
                                <label for="price" class="col-2 col-form-label ">Price</label>
                                <input class="form-control required" type="double" id="price" name="price"
                                placeholder="price">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <div class="col-10">
                                <label for="model_number" class="col-2 col-form-label ">Model Number</label>
                                <input class="form-control required" type="text" id="model_number" name="model_number"
                                       placeholder="model number">
                            </div>
                        </div>
                    </div>
                    <!-- end name en & ar div row  -->

                    <!-- start descriptions en div row -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description" class="col-2 col-form-label ">Description</label>
                            <textarea class="form-control required" rows="5" id="description" name="description"
                                        placeholder="description"></textarea>
                        </div>
                    </div>
                    <!-- end of descriptions en div row -->

                    <!-- start div footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn-submit btn btn-primary btn-md btn-flat">
                            Save <span class="glyphicon glyphicon-save"> </span>
                        </button>
                    </div>
                    <!-- end of div footer -->

                </div>
                <!-- end of class panel  -->

            </form>
            <!-- end of form -->

        </div>
        <!-- end of div panel primary  -->

    </section>
    <!-- end of section -->

@stop

@section('scripts')
<script>
    
$(document).on('submit', ".add-form", function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('action');
    var ajaxSubmit = $this.find('.btn-submit');

    var formData = new FormData(this);
    if ($this.data('url') !== undefined) {
        url = $this.data('url');
    }
    $.ajax({
        url: url,
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        processData: false,
        data: formData,
        contentType: false,

        success: function (data) {
            // success data
            if (data.status == 'success') {
              new Noty({
                  layout   : 'topRight',
                  type     : 'success',
                  theme    : 'relax',
                  timeout  : true,
                  dismissQueue: true,
                  text     : [data.text],
              }).show()

              setTimeout(function() {
                  location.reload();
              }, 2000);

            } else {
                //error code...
                new Noty({
                    layout   : 'topRight',
                    type     : 'error',
                    theme    : 'relax',
                    timeout: 1500,
                    text: [data.text],
                }).show();
            }
        },
        error: function (data) {
          new Noty({
              layout   : 'topRight',
              type     : 'error',
              theme    : 'relax',
              timeout: 1500,
              text: [data.text],
          }).show();
        }
    });
});

</script>

@endsection