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
                            <li class="breadcrumb-item active">Programme Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Details</h3>
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
                                                Modules
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-hover" id="data_table"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>Module Code</th>
                                                            <th>Title</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($programme_modules as $module)
                                                            <tr>
                                                                <td>
                                                                    {{ $module->code }}
                                                                </td>
                                                                <td>
                                                                    {{ $module->title }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success" href="{{ route('editor.module.details', $module->id ) }}">Details</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('editor.programme.module.remove', ['module_id' => $module->id, 'programme_id' => $programme->id]) }}"
                                                                       onclick="return confirm('Are you sure?')"
                                                                       class="btn btn-danger btn-circle">
                                                                        <i class="fas fa-trash"></i>
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

                                    <div class="col-lg-6">
                                        <!-- Default Card Example -->
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                {{ $programme->title }}
                                            </div>
                                            <div class="card-body">
                                                <p>Created By {{ $added_by }}.</p>
                                                <p>Assigned the programme to {{ $programme_users }} students.</p>
                                                <p>Created At {{ $programme->created_at }}.</p>
                                                <p>Updated At {{ $programme->updated_at }}.</p>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Levels
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-hover" id="data_table"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Details</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($programme_levels as $level)
                                                            <tr>
                                                                <td>
                                                                    {{ $level->title }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success btn-circle" href="{{ route('editor.level.details', $level->id ) }}"><i class="material-icons md-18">details</i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('editor.programme.level.remove', ['level_id' => $level->id, 'programme_id' => $programme->id]) }}"
                                                                       onclick="return confirm('Are you sure?')"
                                                                       class="btn btn-danger btn-circle">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                Practicals
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-hover" id="data_table"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Details</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($programme_practicals as $practical)
                                                            @foreach($practical as $i)
                                                                <tr>
                                                                    <td>
                                                                        {{$i->title}}
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-success btn-circle" href="{{ route('editor.practical.details', $i->id ) }}"><i class="material-icons md-18">details</i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
            </div>
        </section>
    </div>

@endsection
