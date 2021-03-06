@extends('layouts.master')

{{--  Title  --}}
@section('title') Institutes list @endsection

@section('styles')
    {{--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.css"/>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Institutes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Institutes</li>
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
                            <h3 class="card-title">List Of Institutes</h3>
                            <a href="{{route('superadmin.institute.create')}}" class="btn btn-outline-success card-tools">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="institutesList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($institutes as $institute)
                                    <tr>
                                        <td>{{$institute->name}}</td>
                                        <td>{{$institute->mobile_no}}</td>
                                        <td>{{$institute->email}}</td>
                                        <td>{{$institute->created_at->format('d F, Y')}}</td>
                                        <td>
                                            <a class="btn btn-outline-info btn-sm" href="{{route('superadmin.institute.details',['institute_id'=>$institute->id])}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-primary btn-sm" href="{{route('superadmin.institute.edit',['institute_id'=>$institute->id])}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{--  <a class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-ban"></i>
                                            </a>  --}}
                                            <a class="btn btn-outline-danger btn-sm" href="">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No records found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
    {{--  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>  --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.js"></script>
    <script src="{{asset('backend/js/datatables.js')}}"></script>
@endsection
