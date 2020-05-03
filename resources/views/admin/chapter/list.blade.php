@extends('layouts.master')

{{--  Title  --}}
@section('title') Chapters list @endsection

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
                    <h1>Chapters</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Chapters</li>
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
                            <h3 class="card-title">List Of Chapters</h3>
                            <a href="{{route('admin.chapter.create')}}"
                                class="btn btn-outline-success card-tools">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="courseList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Chapter Image</th>
                                        <th>Chapter Name</th>
                                        <th>Courses ( Subject )</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chapters as $chapter)
                                    <tr>
                                        <td>
                                           <img
                                                id="chapter-image" 
                                                src="{{!empty($chapter->image)  ? asset($chapter->image) : asset('images/defaults/subject.png')}}"
                                                class="rounded img-max-table"
                                                alt="{{$chapter->chapter_name}}">
                                        </td>
                                        <td>{{$chapter->chapter_name}}</td>
                                        <td>
                                            {{$chapter->course->course_name}} ({{$chapter->subject->subject_name}})
                                        </td>
                                        <td>{{$chapter->created_at->format('d F, Y')}}</td>
                                        <td>
                                            {{--  <a class="btn btn-outline-info btn-sm" href="">
                                                <i class="fas fa-eye"></i>
                                            </a>  --}}
                                            <a class="btn btn-outline-primary btn-sm" href="{{route('admin.chapter.edit',['chapter_id'=>$chapter->id])}}">
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
