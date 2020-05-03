@extends('layouts.master')

{{--  Title  --}}
@section('title') Edit Chapter @endsection

{{--  Styles  --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet" />
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
                    <h1>Edit Chapter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.chapter.list')}}">Chapter</a></li>
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
                            <h3 class="card-title">Edit Chapter</h3>
                            <a href="{{route('admin.chapter.list')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-hand-point-left"></i>
                                Chapters List
                            </a>
                        </div>
                        <!-- form start -->
                        <form role="form" method="POST" id="chapterEditForm" enctype="multipart/form-data"
                            action="{{route('admin.chapter.update',['chapter_id' => $chapter->id])}}">
                            @csrf
                            <div class="card-body">
                                {{--  Course And Subject Name  --}}
                                <div class="row">
                                    {{--  Course Name  --}}
                                    <div class="form-group col-6">
                                        <label for="courseName">Courses <i
                                                class="fa fa-asterisk text-danger"></i></label>
                                        <select id="courseId"
                                            class="form-control select2  {{$errors->has('course') ? 'is-invalid' : ''}}"
                                            name="course" style="width: 100%;">
                                            <option value="" disabled selected>Select Courses</option>
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}" {{ 
                                                old('course') ? 
                                                (($course->id == old('course')) ? 'selected' : '') : 
                                                (($chapter->course_id == $course->id) ? 'selected' : '')
                                            }}>{{$course->course_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('course'))
                                        <span class="error invalid-feedback">{{ $errors->first('course') }}</span>
                                        @endif
                                    </div>
                                    {{--  Subject  --}}
                                    <div class="form-group col-6 select2-info">
                                        <label for="subjectName">Subject <i
                                                class="fa fa-asterisk text-danger"></i></label>
                                        <select
                                            id="subjectId"
                                            class="form-control select2Multiple select2 {{$errors->has('subject') ? 'is-invalid' : ''}}"
                                            name="subject" data-placeholder="Select Subject"
                                            data-dropdown-css-class="select2-info">
                                            <option value="" disabled selected>Select Subject</option>
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}" {{ 
                                                old('subject') ? 
                                                (($subject->id == old('subject')) ? 'selected' : '') : 
                                                (($chapter->subject_id == $subject->id) ? 'selected' : '')
                                            }}>{{$subject->subject_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('subject'))
                                        <span class="error invalid-feedback">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                    {{-- Chapter Name   --}}
                                    <div class="form-group col-6">
                                        <label for="subjectName">Chapter Name <i
                                                class="fa fa-asterisk text-danger"></i></label>
                                        <input type="text"
                                            class="form-control {{$errors->has('chapter_name') ? 'is-invalid' : ''}}"
                                            id="subjectName" placeholder="Enter Chapter Name" name="chapter_name"
                                            value="{{old('chapter_name') ? old('chapter_name') : $chapter->chapter_name }}" required>
                                        @if ($errors->has('chapter_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('chapter_name') }}</span>
                                        @endif
                                    </div>
                                    {{--  Marks Carry --}}
                                    <div class="form-group col-6">
                                        <label for="subjectName">Marks Carry</label>
                                        <input type="number"
                                            class="form-control {{$errors->has('marks_carry') ? 'is-invalid' : ''}}"
                                            id="subjectName" placeholder="Enter Marks Carry" name="marks_carry"
                                            value="{{old('marks_carry') ? old('marks_carry') : $chapter->marks_carry}}">
                                        @if ($errors->has('marks_carry'))
                                        <span class="error invalid-feedback">{{ $errors->first('marks_carry') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Chapter Image  --}}
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="courseImage">Chapter Image </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input uploadImage {{$errors->has('image') ? 'is-invalid' : ''}}"
                                                    id="courseImage" name="image">
                                                <label class="custom-file-label" for="courseImage">Choose file</label>
                                            </div>
                                            @if ($errors->has('image'))
                                            <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="text-center">
                                            <img id="subject-image" 
                                                src="{{!empty($chapter->image) ? asset($chapter->image) : asset('images/defaults/subject.png')}}"
                                                class="rounded img-max" alt="Course Image">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                                <a href="{{route('admin.chapter.list')}}" class="btn  btn-outline-secondary">
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
                $('#chapterEditForm').on('submit', function (e) {
                    $(".loading").show();
                });


                $('.select2').select2()
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

                /*
                 * Get Subject Dropdown
                 */
                $('#courseId').change(function () {

                    // Department id
                    var id = $(this).val();

                    // Empty the dropdown
                    $('#subjectId').find('option').not(':first').remove();

                    getSubjectDropDown(id);
                });

                function getSubjectDropDown(id){
                    // AJAX request 
                    $.ajax({
                        url: '/admin/subject/list-by-course/' + id,
                        type: 'get',
                        dataType: 'json',
                        success: function (response) {
                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                                if (len > 0) {
                                    // Read data and create <option >
                                    for (var i = 0; i < len; i++) {

                                        var id = response['data'][i].id;
                                        var name = response['data'][i].subject_name;

                                        var option = "<option value='" + id + "'>" + name + "</option>";
                                        $("#subjectId").append(option);
                                    }
                                }
                            }


                        }
                    });
                }

                /**
                *Auto Selected Course Fetch Subjects*/
                var oldValue = "{{old('course')}}";
                if(oldValue > 0){
                    getSubjectDropDown(oldValue);
                }
    });

</script>
@endsection
