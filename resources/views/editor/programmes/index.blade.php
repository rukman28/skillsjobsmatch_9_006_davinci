@extends('layouts.editor')
@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Academic Course</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">We maintain skills of the following Academic Courses.</h3>
                            </div>
                            <div class="card-body">
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md">
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('editor.programme.add.view') }}" class="btn btn-primary"
                                               style="margin: 0 10px;">Add New Course</a>
                                            <a href="{{ route('editor.programme.show.bin') }}" class="btn btn-danger"
                                               onclick="return confirm('Please note that if you delete items from the bin, it cannot be recovered.')">Course
                                                Bin</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="data_table" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Course Title</th>
                                                <th>Modify</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($programmes as $programme)
                                                <tr>
                                                    <td>
                                                        {{ $programme->title }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('editor.programme.details', $programme->id) }}"
                                                           class="btn btn-primary btn-icon-split">
                                                            <span class="text">Details</span>
                                                        </a>
                                                        <a href="{{ route('editor.programme.name.update.view', $programme->id) }}"
                                                           class="btn btn-success btn-icon-split">
                                                            <span class="text">Edit Course Details</span>
                                                        </a>
                                                        <a href="{{ route('editor.programme.show.skills', $programme->id) }}"
                                                           class="btn btn-secondary btn-icon-split">
                                                            <span class="text">Skills</span>
                                                        </a>
                                                        <a href="{{ route('editor.programme.delete', $programme->id) }}"
                                                           onclick="return confirm('Are you sure?')"
                                                           class="btn btn-danger btn-icon-split">
                                                            <span class="text">Delete Course Details</span>
                                                        </a>
                                                        {{--
                                                        <a href="{{ route('admin.programme.details', $programme->id) }}"
                                                           class="btn btn-primary btn-icon-split">
                                                            <span class="text">Details</span>
                                                        </a>
                                                        <a href="{{ route('admin.programme.show.skills', $programme->id) }}"
                                                           class="btn btn-secondary btn-icon-split">
                                                            <span class="text">Skills</span>
                                                        </a>
                                                        --}}

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
@endsection
