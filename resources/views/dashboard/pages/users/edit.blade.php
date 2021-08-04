@extends('dashboard.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Edit User</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit User</h3>
        </div><!-- /.box-header -->
        
        <div class="box-body">
            @include('dashboard.partials._errors')
            <!-- form start -->
            <form action="{{route('dashboard.post-update-user', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="box-body">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="userimage">User Image</label>
                        <input type="file" class="form-control image" name="image" >
                    </div>

                    <div class="form-group">
                        <img src="{{ $user->image_path }}" class="img-thumbnail imag-preview" style="width: 100px; height:100px" alt="">                    
                    </div>

                </div><!-- /.box-body -->

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <p>Admins</p>
                        <div class="nav-tabs-custom">

                            @php
                                $models = ['users', 'products', 'categories', 'customers'];
                                $maps   = ['create', 'read', 'update', 'delete'];
                            @endphp

                            <ul class="nav nav-tabs">
                                @foreach($models as $index => $model)
                                    <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($models as $index => $model)
                                    <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                                        @foreach($maps as $map)
                                            <label for="checkbox"><input type="checkbox" name="permissions[]" {{ $user->hasPermission($map . '_' . $model) ? 'checked' : 0}} value="{{$map . '_' . $model}}"> {{ $map }}</label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- nav-tabs-custom -->
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit User</button>
                    </div>
            </form>
        </div>

    </div><!-- /.box -->
@stop   