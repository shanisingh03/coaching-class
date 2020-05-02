@extends('layouts.master')

{{--  Title  --}}
@section('title') Institute Details @endsection

{{--  Styles  --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />
@endsection

{{--  Section  --}}
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    {{--  Flash Messages  --}}
    @include('common.flash')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Institute Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('superadmin.institute.list')}}">Institute</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                {{--  Institute Details  --}}
                <div class="row">
                    <div class="col-2 mycontent-left">
                        <img src="{{!empty($institute->logo) ? asset('uploads/institutes/logo/'.$institute->logo) : asset('images/logo.png')}}"
                            class="ounded img-max" alt="Institute LOGO">
                    </div>
                    <div class="col-3 mycontent-left">
                        <h3>{{$institute->name}}</h3>
                        <p>{{$institute->tag_line}}</p>
                    </div>
                    <div class="col-3 mycontent-left">
                        <p> <strong>Email:</strong> {{$institute->email}}</p>
                        <p> <strong>Mobile No.:</strong> {{$institute->mobile_no}}</p>
                        <p> <strong>Since:</strong> {{Carbon\Carbon::parse($institute->regsitered_at)->format('d/m/Y')}}
                        </p>
                    </div>
                    <div class="col-4 text-center">
                        <p> <strong>Website:</strong> {{$institute->website}}</p>
                        <p> <strong>Address:</strong> {{$institute->address}}</p>
                        <p> <strong>Registered At:</strong> {{$institute->created_at->format('d/m/Y')}}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="administrator-tab" data-toggle="tab"
                                href="#administrator" role="tab" aria-controls="administrator"
                                aria-selected="true">Administrators</a>
                            <a class="nav-item nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Settings</a>
                            <a class="nav-item nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab"
                                aria-controls="report" aria-selected="false">Report</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3 col-12" id="nav-tabContent">
                        {{--    --}}
                        <div class="tab-pane fade show active" id="administrator" role="tabpanel"
                            aria-labelledby="administrator-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Administrators of Institutes</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-outline-success" id="addAdmin">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($institute->admins as $institute_admin)
                                            <tr>
                                                <td>{{$institute_admin->user->full_name}}</td>
                                                <td>{{$institute_admin->user->email}}</td>
                                                <td>{{$institute_admin->user->mobile}}</td>
                                                <td>
                                                    @if(!empty($institute_admin->email_verified_at))
                                                    <span class="badge badge-success">Verified</span>
                                                    @else
                                                    <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-primary btn-sm" href="">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-ban"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm" href="">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Institute Admins found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                        {{--  Settings  --}}
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        </div>

                        {{--  Reports  --}}
                        <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    {{--  Modal ADD New  --}}
    <div class="modal fade" id="addAdminModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Administrator</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{route('superadmin.institute.admin.create')}}">
                    @csrf
                    <input type="hidden" name="institute_id" value="{{$institute->id}}" />
                    <div class="modal-body">
                        {{--  Name  --}}
                        <div class="row">
                            {{--  First Name  --}}
                            <div class="form-group col-6">
                                <label for="firstName">First Name <i class="fa fa-asterisk text-danger"></i></label>
                                <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}"
                                    id="firstName" placeholder="Enter First Name" name="first_name"
                                    value="{{old('first_name')}}" required>
                                @if ($errors->has('first_name'))
                                <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            {{--  Last Name  --}}
                            <div class="form-group col-6">
                                <label for="instituteTagLine">Last Name <i class="fa fa-asterisk text-danger"></i></label>
                                <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}"
                                    id="instituteTagLine" placeholder="Enter Last Name" name="last_name"
                                    value="{{old('last_name')}}">
                                @if ($errors->has('last_name'))
                                <span class="error invalid-feedback">{{ $errors->first('tag_line') }}</span>
                                @endif
                            </div>
                        </div>
                        {{--  Mobile and email  --}}
                        <div class="row">
                            {{--  Institute Email  --}}
                            <div class="form-group col-6">
                                <label for="instituteEmail"> Email <i class="fa fa-asterisk text-danger"></i></label>
                                <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                                    id="instituteEmail" placeholder="Enter Email of Administrator" name="email"
                                    value="{{old('email')}}" required>
                                @if ($errors->has('email'))
                                <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            {{--  Institute Mobile  --}}
                            <div class="form-group col-6">
                                <label for="instituteMobileNo">Institute Mobile No. <i
                                        class="fa fa-asterisk text-danger"></i></label>
                                <input type="text" class="form-control {{$errors->has('mobile') ? 'is-invalid' : ''}}"
                                    id="instituteMobileNo" placeholder="Enter Mobile No of Administrator" name="mobile"
                                    value="{{old('mobile')}}">
                                @if ($errors->has('mobile'))
                                <span class="error invalid-feedback">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
<!-- /.content-wrapper -->

@endsection

{{--  Scripts  --}}
@section('scripts')
<script>
    $(document).ready(function(){
        //Click On Add Button
        $("#addAdmin").click(function(){
            $("#addAdminModal").modal('show');
        });

        @if($errors->count())
        $("#addAdminModal").modal('show');
        @endif
    });
</script>
@endsection
