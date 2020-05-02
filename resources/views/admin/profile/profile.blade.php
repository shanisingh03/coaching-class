@extends('layouts.master')

{{--  Title  --}}
@section('title') Add Institute @endsection

{{--  Styles  --}}
@section('styles')

@endsection

{{--  Section  --}}
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{--  Flash Messages  --}}
            @include('common.flash')

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('images/user.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$user->full_name}}</h3>

                            <p class="text-muted text-center">{{$user->role->name}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Registered At</b> <a class="float-right">{{$user->created_at->format('d F, Y')}}</a>
                                </li>
                            </ul>

                            {{--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>  --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link {{(isset($activeTab) && ($activeTab == 'profile')) ? 'active' : ''}}" href="#profile-data"
                                        data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link {{(isset($activeTab) && ($activeTab == 'change-password')) ? 'active' : ''}}" href="#change-password" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                {{--  Profile Data  --}}
                                <div class="tab-pane {{(isset($activeTab) && ($activeTab == 'profile')) ? 'active' : ''}}" id="profile-data">
                                    <form class="form-horizontal" method="POST" action="{{route('admin.profile.update')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}" />
                                        <div class="form-group row">
                                            <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="firstName" placeholder="First Name" name="first_name" required value="{{old('first_name') ? old('first_name') : $user->first_name }}">
                                                @error('first_name')
                                                    <span class="error invalid-feedback">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="lastName" placeholder="Last Name" name="last_name" required value="{{old('last_name') ? old('last_name') : $user->last_name }}">
                                                @error('last_name')
                                                    <span class="error invalid-feedback">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="Email" placeholder="Email" name="email" required value="{{old('email') ? old('email') : $user->email }}">
                                                @if($errors->has('email'))
                                                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Mobile" class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control {{$errors->has('mobile') ? 'is-invalid' : ''}}" id="Mobile" placeholder="Mobile Number" name="mobile" required value="{{old('mobile') ? old('mobile') : $user->mobile }}">
                                                @error('mobile')
                                                    <span class="error invalid-feedback">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{--  Change Password  --}}
                                <div class="tab-pane {{(isset($activeTab) && ($activeTab == 'change-password')) ? 'active' : ''}}" id="change-password">
                                    <form class="form-horizontal" method="post" action="{{route('admin.profile.change-password')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}" />
                                        <div class="form-group row">
                                            <label for="oldPassword" class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control {{$errors->has('current_password') ? 'is-invalid' : ''}}" id="oldPassword" placeholder="Enter old Password" name="current_password" required>
                                                @error('current_password')
                                                    <span class="error invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control {{$errors->has('new_password') ? 'is-invalid' : ''}}" id="newPassword" placeholder="Enter new Password" name="new_password" required>
                                                @error('new_password')
                                                    <span class="error invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="confirmNewPassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="confirmNewPassword" placeholder="Confirm New Password" name="new_confirm_password" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Chnage Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
<!-- /.content-wrapper -->
@endsection

{{--  Scripts  --}}
@section('scripts')

@endsection
