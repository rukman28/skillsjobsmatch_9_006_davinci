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
                            <li class="breadcrumb-item active">Skills</li>
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
                                <h3 class="card-title">Following are the skills of the {{ $programme->title }} course.</h3>
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="data_table" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Skill Title</th>
                                                <th>Times practised</th>
                                                <th>Skill Details</th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            @foreach($user_skill_list as $key=>$val)
                                                <tr>
                                                    <td>
                                                        {{ $key }}
                                                    </td>
                                                    <td>
                                                        {{ $val }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('editor.skill.show.details', $key) }}"
                                                           class="btn btn-primary btn-icon-split">
                                                                            <span class="icon text-white-50">
                                                                                <i class="fas fa-info"></i>
                                                                            </span>
                                                            <span class="text">Details</span>
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
                </div>
            </div>
        </section>
    </div>
@endsection
