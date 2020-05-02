@extends('layouts.master')

{{--  Title  --}}
@section('title') Add Institute @endsection

{{--  Styles  --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}"/>
@endsection

{{--  Section  --}}
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Institute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('superadmin.institute.list')}}">Institute</a></li>
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
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Add Institute</h3>
                            <a href="{{route('superadmin.institute.list')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-hand-point-left"></i>
                                Institute List
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <add-institute></add-institute>
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
@endsection
