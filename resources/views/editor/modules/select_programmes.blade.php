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
                            <li class="breadcrumb-item"><a href="{{ route('editor.module.details', $module->id) }}">Selected Module</a></li>
                            <li class="breadcrumb-item active">Add Programme To Module</li>
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
                                <h3 class="card-title">Select a course and academic level to add into the module.</h3>
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
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Add academic course
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('editor.module.add.programme') }}" method="post">
                                                    <div class="form-group">
                                                        @csrf
                                                        <label for="title">Module Code.</label>
                                                        <input type="text" class="form-control" id="code" name="code" aria-describedby="code" value="{{ $module->code }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        @csrf
                                                        <label for="title">Module Title.</label>
                                                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="{{ $module->title }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Select the academic course from the dropdown menu</label>
                                                        <select class="custom-select  rounded-1" id="exampleSelectBorder" name="programme_id">
                                                            @foreach($available_programmes as $programme)
                                                                <option value="{{ $programme->id }}">{{ $programme->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Select the academic level from the dropdown menu</label>
                                                        <select class="custom-select  rounded-1" id="exampleSelectBorder" name="level_id">
                                                            @foreach($levels as $level)
                                                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input name="module_id" type="hidden" value="{{ $module->id }}">
                                                    <button type="submit" class="btn btn-primary">Add academic course</button>
                                                </form>
                                            </div>
                                        </div>

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
