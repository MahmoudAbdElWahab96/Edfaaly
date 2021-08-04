@extends('dashboard.layouts.master')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Users</small>
        </h1>
    </section>

    <div class="box box-primary">
        <div class="box-header">
             <!-- tools box -->
             <div class="pull-right box-tools">                                        
                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
            </div>
            <i class="fa fa-user"></i>
            <h3 class="box-title">Users <small class="badge bg-green">{{$users->total()}}</small></h3>
            
            <form action="{{route('dashboard.get-all-users')}}" method="GET">

                <div class="row" style="margin-top: 6px">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search Users" value="{{request()->search}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary  btn-flat"><i class="fa fa-search"></i> Search</button>
                        @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{route('dashboard.get-add-user')}}" class="btn btn-primary  btn-flat" style="color: #fff"><i class="fa fa-plus"></i> Add User</a>
                        @else 
                            <a class="btn btn-primary disabled" style="color: #fff"><i class="fa fa-plus  btn-flat"></i> Add User</a>
                        @endif
                        
                    </div>
                </div>

            </form>
        </div><!-- /.box-header -->
        
        <div class="box-body">
                
                <div class="box-body no-padding ">
                    @if($users->count() > 0)
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>User Image</th>
                                <th>action</th>
                            </tr>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <th>{{$index + 1}}</th>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="text-center"><img src="{{ $user->image_path }}" alt="" width="100px" height="100px" class="img-thumbnail"></td>
                                        <td>
                                            <div style="display: flex">
                                                @if(auth()->user()->hasPermission('update_users'))
                                                    <a href="{{route('dashboard.get-update-user', $user->id)}}" class="btn btn-info btn-sm  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled  btn-flat"><i class="fa fa-pencil"></i> Update</a>
                                                @endif
                                                
                                                @if(auth()->user()->hasPermission('delete_users'))
                                                    <form action="{{route('dashboard.delete-admin', $user->id)}}" method="GET">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger delete btn-sm btn-flat" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </form>
                                                @else 
                                                    <button type="submit" class="btn btn-danger btn-sm disabled btn-flat delete" style="margin-left: 10px"><i class="fa fa-trash-o"></i> Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->appends(request()->query())->links() }}
                    @else
                        <h2>No Records</h2>
                    @endif
                </div><!-- /.box-body -->
        </div>

    </div><!-- /.box -->

@stop