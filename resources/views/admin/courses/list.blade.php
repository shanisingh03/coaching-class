@extends('layouts.master')

{{--  Title  --}}
@section('title') Course list @endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.css" />
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Courses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    {{--  Flash Messages  --}}
                    @include('common.flash')

                    {{--  List Card  --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Of Courses</h3>
                            <a href="{{route('admin.course.create')}}"
                                class="btn btn-outline-success card-tools">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="courseList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Course Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            <img 
                                                src="{{!empty($course->image) ? asset('uploads/institutes/'.$course->institute_id.'/courses/'.$course->image) : asset('images/defaults/course.png')}}"
                                                class="rounded img-max-table text-center"
                                                alt="{{$course->name}}">
                                        </td>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$course->created_at->format('d F, Y')}}</td>
                                        <td>
                                            {{--  <a class="btn btn-outline-info btn-sm" href="">
                                                <i class="fas fa-eye"></i>
                                            </a>  --}}
                                            <a class="btn btn-outline-primary btn-sm" href="{{route('admin.course.edit',['course_id'=>$course->id])}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

{{--  Include Datatable JS  --}}
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.js"></script>
<script src="{{asset('backend/js/datatables.js')}}"></script>
@endsection
