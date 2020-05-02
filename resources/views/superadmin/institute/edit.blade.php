@extends('layouts.master')

{{--  Title  --}}
@section('title') Edit Institute @endsection

{{--  Styles  --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@endsection

{{--  Section  --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Institute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('superadmin.institute.list')}}">Institute</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--  Flash Messages  --}}
                    @include('common.flash')

                    {{--  Card  --}}
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Edit Institute</h3>
                            <a href="{{route('superadmin.institute.list')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-hand-point-left"></i>
                                Institute List
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" id="instituteUpdateForm"  enctype="multipart/form-data" action="{{route('superadmin.institute.update')}}">
                            @csrf
                            <div class="card-body">
                                {{--  Institute Name And Tag Line  --}}
                                <div class="row">
                                    <input type="hidden" name="id" value="{{$institute->id}}" />
                                    {{--  INstitute Name  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteName">Institute Name <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="instituteName"
                                            placeholder="Enter Institute Name" name="name" value="{{old('name') ? old('name') : $institute->name}}" required>
                                        @if ($errors->has('name'))
                                            <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    {{--  Tag Line  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteTagLine">Institute Tag Line</label>
                                        <input type="text" class="form-control {{$errors->has('tag_line') ? 'is-invalid' : ''}}" id="instituteTagLine"
                                            placeholder="Enter Institute Tag Line" name="tag_line" value="{{old('tag_line') ? old('tag_line') : $institute->tag_line}}">
                                        @if ($errors->has('tag_line'))
                                            <span class="error invalid-feedback">{{ $errors->first('tag_line') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Mobile and email  --}}
                                <div class="row">
                                    {{--  Institute Email  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteEmail">Institute Email <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="instituteEmail"
                                            placeholder="Enter Institute Email" name="email" value="{{old('email') ? old('email') : $institute->email}}" required>
                                        @if ($errors->has('email'))
                                            <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    {{--  Institute Mobile  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteMobileNo">Institute Mobile No. <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control {{$errors->has('mobile_no') ? 'is-invalid' : ''}}" id="instituteMobileNo"
                                            placeholder="Enter Institute Mobile No" name="mobile_no" value="{{old('mobile_no') ? old('mobile_no') : $institute->mobile_no}}">
                                        @if ($errors->has('mobile_no'))
                                            <span class="error invalid-feedback">{{ $errors->first('mobile_no') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{--  Website and Registered At  --}}
                                <div class="row">
                                    {{--  Institute Website  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteWebsite">Institute Website </label>
                                        <input type="text" class="form-control {{$errors->has('website') ? 'is-invalid' : ''}}" id="instituteWebsite"
                                            placeholder="Enter Institute Website" name="website" value="{{old('website') ? old('website') : $institute->website}}">
                                        @if ($errors->has('website'))
                                            <span class="error invalid-feedback">{{ $errors->first('website') }}</span>
                                        @endif
                                    </div>
                                    {{--  Institute Registered At  --}}
                                    <div class="form-group col-6">
                                        <label for="instituteRegisteredAt">Institute Registered At <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control datetimepicker {{$errors->has('registered_at') ? 'is-invalid' : ''}}" id="instituteRegisteredAt"
                                            placeholder="Enter Institute Mobile No" name="registered_at" value="{{old('registered_at') ? old('registered_at') : Carbon\Carbon::parse($institute->registered_at)->format('d/m/Y') }}">
                                        @if ($errors->has('registered_at'))
                                            <span class="error invalid-feedback">{{ $errors->first('registered_at') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{--  Institute Logo  --}}
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="instituteLogo">Institute Logo </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input uploadImage {{$errors->has('logo') ? 'is-invalid' : ''}}" id="instituteLogo" name="logo" >
                                                <label class="custom-file-label" for="instituteLogo">Choose file</label>
                                            </div>
                                            @if ($errors->has('logo'))
                                                <span class="error invalid-feedback">{{ $errors->first('logo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="text-center">
                                            <img src="{{!empty($institute->logo) ? asset('uploads/institutes/logo/'.$institute->logo) : asset('images/logo.png')}}" class="rounded img-max" alt="{{$institute->name}}" id="institute-logo">
                                        </div>
                                    </div>
                                </div>

                                {{--  Address  --}}
                                <div class="form-group">
                                    <label for="instituteAddress">Address <i class="fa fa-asterisk text-danger"></i></label>
                                    <textarea class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" rows="3" placeholder="Enter Institute Address" name="address">{{old('address') ? old('address') : $institute->address}}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="error invalid-feedback">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                                <a href="{{route('superadmin.institute.list')}}" class="btn  btn-outline-secondary">
                                    <i class="fas fa-window-close"></i>
                                Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

{{--  Scripts  --}}
@section('scripts')
<script src="{{asset('backend/js/custom.js')}}"></script>
{{--  Moment With Date picker  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
$(function () {
    //Date Picker
    $('.datetimepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy'
    });

    //Handle Submit Of Form
    $('#instituteUpdateForm').on('submit', function(e) { 
        $(".loading").show();
    });

    /*  ==========================================
    SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#institute-logo')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $('.uploadImage').on('change', function () {
            readURL(this);
            var fileName = this.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
    });
});
</script>
@endsection
