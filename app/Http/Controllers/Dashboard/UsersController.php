<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Image;
use Storage;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    
    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->when($request->search, function($query) use ($request) {
            return $query->where('first_name', 'like', '%' . $request->search . '%')
            ->orWhere('last_name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);
    
        return view('dashboard.pages.users.index', compact('users'));
    }

    public function getAddUser() {
        return view('dashboard.pages.users.create');
    }

    public function postAddUser(Request $request) {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'image' => 'image',
            'permissions' => 'required|min:1'
        ];

        $messages = [
            'first_name.required' => 'Please Enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'password.required' => 'Please enter the password',
            'password.confirmed' => 'Passwords does not match',
            'email.unique'  => 'This email has been already Taken!',
            'image.image' => 'Please upload an image not file',
            'permissions.required' => 'Please choose at least one permission for this admin',
        ];

        $request->validate($rules);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if($request->image) {
            Image::make($request->image)
            ->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('uploads/images/users/' . $request->image->hashName()), 100);
            $request_data['image'] = $request->image->hashName();
        }

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', 'User Added Successfully!');
        return redirect()->route('dashboard.get-all-users');
    }

    public function getUpdateUser($id) {
        $user = User::find($id);
        return view('dashboard.pages.users.edit', compact('user'));
    }

    public function postUpdateUser(Request $request, $id) {
        // dd($request);
        $user = User::find($id);
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            'image' => 'image',
            'permissions' => 'required|min:1'
        ];

        $messages = [
            'first_name.required' => 'Please Enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'email.unique'  => 'This email has been already Taken!',
            'image.image' => 'Please upload an image not file',
            'permissions.required' => 'Please choose at least one permission for this admin',
        ];

        $request->validate($rules, $messages);

        $request_data = $request->except(['permissions', 'image']);

        if($request->image) {
           if($user->image != 'default.jpg') {
                Storage::disk('storage_uploads')->delete('/users/' . $user->image);
            }

            Image::make($request->image)
            ->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('uploads/images/users/' . $request->image->hashName()), 100);
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success', 'User Updated Successfully!');
        return redirect()->route('dashboard.get-all-users');

    }
    
    public function deleteAdmin($id) {
        $user = User::find($id);
        if($user->image != 'default.jpg') {
            Storage::disk('storage_uploads')->delete('/users/' . $user->image);
        }

        $user->delete();
        session()->flash('success', 'User Deleted Successfully!');
        return redirect()->route('dashboard.get-all-users');
    }
}
