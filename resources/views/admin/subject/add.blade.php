@extends('layouts.master')

{{--  Title  --}}
@section('title') Add Subject @endsection

{{--  Styles  --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

{{--  Section  --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Subject</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.subject.list')}}">Subject</a></li>
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
                            <h3 class="card-title">Add Subject</h3>
                            <a href="{{route('admin.subject.list')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-hand-point-left"></i>
                                Subject List
                            </a>
                        </div>
                        <!-- form start -->
                        <form role="form" method="POST" id="subjectCreateForm"  enctype="multipart/form-data" action="{{route('admin.subject.store')}}">
                            @csrf
                            <div class="card-body">
                                {{--  Course And Subject Name  --}}
                                <div class="row">
                                    {{--  Course Name  --}}
                                    <div class="form-group col-6 select2-info">
                                        <label for="courseName">Courses <small>(You can select multiple)</small> <i class="fa fa-asterisk text-danger"></i></label>
                                        <select class="form-control select2Multiple select2 {{$errors->has('course_name') ? 'is-invalid' : ''}}" name="course_name[]" multiple="multiple" data-placeholder="Select courses" data-dropdown-css-class="select2-info">
                                            <option value="" disabled>Select Courses</option>
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}" 
                                            {{ 
                                                old('course_name') ? 
                                                (in_array($course->id,old('course_name')) ? 'selected' : '') : 
                                                ''
                                            }}>{{$course->course_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('course_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('course_name') }}</span>
                                        @endif
                                    </div> 
                                    {{-- Subject Name   --}}
                                    <div class="form-group col-6">
                                        <label for="subjectName">Subject Name <i class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text" class="form-control {{$errors->has('subject_name') ? 'is-invalid' : ''}}" id="subjectName"
                                            placeholder="Enter Subject Name" name="subject_name" value="{{old('subject_name')}}" required>
                                        @if ($errors->has('subject_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('subject_name') }}</span>
                                        @endif
                                    </div>                                    
                                </div>
                                {{--  Subject Image  --}}
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="courseImage">Subject Image </label>
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
                                                id="subject-image" 
                                                src="{{asset('images/defaults/subject.png')}}"
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
                                <a href="{{route('admin.subject.list')}}" class="btn  btn-outline-secondary">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>

<script>
$(function () {
    //Date Picker
    $('.datetimepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy'
    });

    //Handle Submit Of Form
    $('#subjectCreateForm').on('submit', function(e) { 
        $(".loading").show();
    });


    $('.select2Multiple').select2();
    /*  ==========================================
    SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#subject-image')
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
