@extends('layouts.master')

{{--  Title  --}}
@section('title') Add Courses @endsection

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
                    <h1>Add Courses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.course.list')}}">Courses</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                            <h3 class="card-title">Add Course</h3>
                            <a href="{{route('admin.course.list')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-hand-point-left"></i>
                                Course List
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" id="courseCreateForm"  enctype="multipart/form-data" action="{{route('admin.course.store')}}">
                            @csrf
                            <div class="card-body">
                                {{--  Course Name  --}}
                                <div class="row">
                                    {{--  Course Name  --}}
                                    <div class="form-group col-12">
                                        <label for="courseName">Course Name <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control {{$errors->has('course_name') ? 'is-invalid' : ''}}" id="courseName"
                                            placeholder="Enter Course Name" name="course_name" value="{{old('course_name')}}" required>
                                        @if ($errors->has('course_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('course_name') }}</span>
                                        @endif
                                    </div>                                    
                                </div>
                                {{--  Course Image  --}}
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="courseImage">Course Image </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input uploadImage {{$errors->has('image') ? 'is-invalid' : ''}}" id="courseImage" name="image" >
                                                <label class="custom-file-label" for="courseImage">Choose file</label>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="text-center">
                                            <img
                                                id="course-image" 
                                                src="{{asset('images/defaults/course.png')}}"
                                                class="rounded img-max"
                                                alt="Course Image">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                                <a href="{{route('admin.course.list')}}" class="btn  btn-outline-secondary">
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
    $('#courseCreateForm').on('submit', function(e) { 
        $(".loading").show();
    });

    /*  ==========================================
    SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#course-image')
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
