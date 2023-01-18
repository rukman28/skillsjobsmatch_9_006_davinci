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
                            <li class="breadcrumb-item active">Level Details</li>
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
                                <h3 class="card-title">Academic Levels</h3>
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
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Assigned Programmes
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover" id="data_table_tb">
                                                        <thead>
                                                        <tr>
                                                            <th>Programme</th>
                                                            <th>Details</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($level_programmes as $programme)
                                                            <tr>
                                                                <td>
                                                                    {{ $programme->title }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success btn-circle" href="{{ route('editor.programme.details', $programme->id ) }}"><i class="material-icons md-18">details</i></a>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('editor.levels.remove.programme') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                               name="level_id"
                                                                               value="{{ $level->id }}"/>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="{{ $programme->id }}"/>
                                                                        <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="material-icons md-18">delete</i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Assigned Modules
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Module Code</th>
                                                            <th>Module Name</th>
                                                            <th>Details</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($level_modules as $module)
                                                            <tr>
                                                                <td>
                                                                    {{ $module->code }}
                                                                </td>
                                                                <td>
                                                                    {{ $module->title }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success btn-circle" href="{{ route('editor.module.details', $module->id ) }}"><i class="material-icons md-18">details</i></a>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('editor.levels.remove.modules') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                               name="level_id"
                                                                               value="{{ $level->id }}"/>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="module_id" value="{{ $module->id }}"/>
                                                                        <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="material-icons md-18">delete</i></button>
                                                                    </form>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Level Details</h3>
                            </div>
                            <div class="card-body">
                                <p>Created By {{ $added_by }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
