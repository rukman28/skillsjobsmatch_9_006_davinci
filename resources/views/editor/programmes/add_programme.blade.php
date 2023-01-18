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
                            <li class="breadcrumb-item active">Academic Programme</li>
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
                                <h3 class="card-title">Enter a new Programme name followed by academic year.</h3>
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
                                                Add New Programme
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('editor.programme.store') }}" method="post">
                                                    <div class="form-group">
                                                        @csrf
                                                        <label for="title">Enter the Programme name.</label>
                                                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Programme Name">
                                                        <small id="Help" class="form-text text-muted">You can use academic year to differentiate old and new syllabus.</small>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add New Programme</button>
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
