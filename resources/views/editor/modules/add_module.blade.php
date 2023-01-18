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
                            <li class="breadcrumb-item"><a href="{{ route('editor.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add New Module</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Module Details</h3>
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
                                    <div class="col-lg-6">
                                        <!-- Default Card Example -->

                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">New Module Details</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <!-- form start -->
                                                <form action="{{ route('editor.module.store') }}" method="POST">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInput1">Module code</label>
                                                            <input type="text" class="form-control" id="exampleInput1" name="code" placeholder="Enter Module Code">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput2">Module title</label>
                                                            <input type="text" class="form-control" id="exampleInput2" name="title" placeholder="Module Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleSelectBorder">Select the course from the dropdown menu</label>
                                                            <select class="custom-select  rounded-1" id="exampleSelectBorder" name="programme_id">
                                                                @foreach($programmes as $programme)
                                                                    <option value="{{ $programme->id }}">{{ $programme->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleSelectBorder">Select the level from the dropdown menu</label>
                                                            <select class="custom-select  rounded-1" id="exampleSelectBorder" name="level_id">
                                                                @foreach($levels as $level)
                                                                    <option value="{{ $level->id }}">{{ $level->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.card -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
