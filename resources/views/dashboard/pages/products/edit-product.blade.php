@extends('admin.master')

@section('content-header')
    <section class="content-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><h4>Products</h4></li>
                <li class="breadcrumb-item"><a href="{{  route('admin.home')  }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{  route('admin.products.getIndex')  }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{  route('admin.products.getUpdateProduct', ['id' => $product->id])  }}">Edit Products</a>
                </li>
            </ol>
        </nav>
    </section>
@endsection

@section('content')

    <!-- start class content -->
    <section class="content">

        <!-- start div panel-primary  -->
        <div class="panel panel-primary">

            <!-- Default panel contents -->
            <div class="panel-heading" style="font-size: large">Products</div>

            <!-- start form submited -->
            <form action="{{ route('admin.products.updateProduct',[ 'id' => $product->id ]) }}" onsubmit="return false;" method="post"
                  class="update-form">

                {!! csrf_field() !!}

                <!-- start panel-body -->
                <div class="panel-body">

                    <!-- start name en & ar labels div row -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name" class="col-2 col-form-label ">Product Name EN</label>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="name" class="col-2 col-form-label" style="float: right;">اسم المنتج باللغة العربيه</label>
                        </div>
                    </div>
                    <!-- end name en & ar div row -->

                    <!-- start name en & ar div row -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="col-10">
                                <input class="form-control required" type="text" id="name_en" name="name_en"
                                placeholder="name in english" value="{{$product->en->name}}">
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <div class="col-10">
                                <input class="form-control required" type="text" id="name_ar" name="name_ar"
                                       placeholder="الاسم باللغة العربية" value="{{$product->ar->name}}">
                            </div>
                        </div>
                    </div>
                    <!-- end of name en & ar div row -->

                    <!-- start category and product type div row -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="category" class="col-2 col-form-label">Category</label>
                            <div class="col-10">

                                <select class="form-control" name="category_id">
                                    @foreach($menus as $menu)
                                        <optgroup label="{{$menu->trans->menu}} - menu" style="color: red;">

                                            @foreach($menu->categories as $category)
                                                <optgroup label="{{$category->trans->category}} - main category"
                                                    style="color: green; font-weight: 100">

                                                    @foreach($category->sub_categories as $sub_category)
                                                        <option value="{{$sub_category->id}}"
                                                            {{$product->category_id == $sub_category->id ? 'selected' : ''}}
                                                             style="color: black;">
                                                            {{$sub_category->trans->category}}
                                                        </option>
                                                    @endforeach

                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="type" class="col-2 col-form-label">Type</label>
                            <div class="col-10">
                                <select class="form-control" name="type_en" id="type">
                                    <option value="normal" {{$product->type == 'normal' ? 'selected' : ''}}>normal</option>
                                    <option value="option" {{$product->type == 'option' ? 'selected' : ''}}>option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- end of category and product type div row -->

                    <!-- start description en div row -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description" class="col-2 col-form-label ">Description EN</label>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="col-10">
                                    <textarea class="form-control" rows="3" id="description_en" name="description_en"
                                              placeholder="description in english">{!!$product->en->description!!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end of description en div row -->

                    <!-- start description ar div row -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description" class="col-2 col-form-label" style="float: right;">الوصف باللغة العربيه</label>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="col-10">
                                    <textarea class="form-control" rows="3" id="description_ar" name="description_ar"
                                              placeholder="الوصف باللغة العربية">{!!$product->ar->description!!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end of description ar div row -->

                    <!-- strart notes en div row -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="notes" class="col-2 col-form-label">Notes EN</label>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="col-10">
                                <textarea class="form-control " rows="5" id="notes_en" name="notes_en"
                                          placeholder="notes in english">{!!$product->en->notes!!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end of notes en div row -->

                    <!-- start notes ar div row -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="notes" class="col-2 col-form-label">الملاحظات باللغة العربيه</label>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="col-10">
                                <textarea class="form-control " rows="5" id="notes_ar" name="notes_ar"
                                          placeholder="الملاحظات باللغة العربيه">{!!$product->ar->notes!!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end of notes en div row -->

                    <!-- /.box-header -->

                        <div class="box-body">
                            <div class="row">
                                @foreach ($product->images as $image)
                                    <div class="col-md-4 ajax-target">
                                        <div class="thumbnail">
                                            <img alt="290X180"
                                                style="height: 200px; width: 350px; display: block; cursor: pointer;"
                                                src="{{asset('storage/images/products/' . $image->image)}}"
                                                data-holder-rendered="true">
                                            <div class="caption text-center">
                                                <button type="button" data-url="{{ route('admin.images.delete' ,['imageId' => $image->id ]) }}" class="remove-image-box btn btn-warning"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-4 file-box">
                                    <div class="thumbnail">
                                        <img alt="290X180" class="file-btn"
                                            style="height: 200px; width: 350px;  display: block; cursor: pointer;"
                                            src="http://via.placeholder.com/350x20" data-holder-rendered="true">
                                        <div class="caption text-center">
                                            <input type="file" class="col-md-8 btn btn-primary" role="button" name="imgs[]" accept="image/*">
                                            <button type="button" class="file-generate btn btn-success"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->

                    <!-- start footer div  -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning btn-md btn-flat">
                            Edit <span class="glyphicon glyphicon-save"> </span>
                        </button>
                    </div>
                    <!-- end footer div  -->

                </div>
                <!--end of panel div  -->

            </form>
            <!-- end of submited form -->

        </div>
        <!-- end of panel-primary div -->

    </section>
    <!-- end of section -->
@endsection

@section('scripts')

<script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
<script>

CKEDITOR.replace('description_en');
CKEDITOR.replace('description_ar');
CKEDITOR.replace('notes_en');
CKEDITOR.replace('notes_ar');

function previewURL(btn, input) {

      if (input.files && input.files[0]) {

          // collecting the file source
          var file = input.files[0];
          // preview the image
          var reader = new FileReader();
          reader.onload = function (e) {
              var src = e.target.result;
              btn.attr('src', src);
          };
          reader.readAsDataURL(file);
      }
  }

  function validateImgFile(input) {
    if (input.files && input.files[0]) {

        // collecting the file source
        var file = input.files[0];
        // validating the image name
        if (file.name.length < 1) {
            alert("The file name couldn't be empty");
            return false;
        }
        // validating the image size
        // else if (file.size > 300000) {
        //     alert("The file is too big");
        //     return false;
        // }
        // validating the image type
        else if (file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg') {
            alert("The file does not match png, jpg or gif");
            return false;
        }
        return true;
    }
}

  $(document).on('click', '.file-generate', function () {
        var $this = $(this);
        var fileBox = $this.closest('.file-box');
        var newBox = $('div.file-box:first').clone();
        newBox.find('img').prop('src' , 'http://via.placeholder.com/350x200');
        newBox.find('.caption').append('<button type="button" class="file-remove btn btn-danger"><i class="fa fa-minus fa-lg" aria-hidden="true"></i></button>');
        fileBox.after(newBox);

    });

    $(document).on('click', '.file-remove', function () {
        var $this = $(this);
        $this.closest('.file-box').remove();
    });


    $(document).on('click', '.file-btn', function () {
        $(this).closest('.file-box').find('input[type=file]').click();
    });
    $(document).on('change', '.file-box input[type=file]', function () {
        var fileBtn = $(this).closest('.file-box').find('.file-btn');
        if (validateImgFile(this)) {
            previewURL(fileBtn, this);
        }
    });


    $(document).on('click', ".remove-image-box", function (e) {
        e.preventDefault();

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            var $this = $(this);
            var url = $this.data('url');

            $.ajax({
                url: url,
                method: 'GET',
                success: function() {

                    $this.closest('.ajax-target').fadeOut(500);

                    swal("Poof! Your imaginary file has been deleted!", {
                      icon: "success",
                    });
                }
            });

          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });


</script>

@endsection
