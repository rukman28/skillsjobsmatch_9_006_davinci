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
                            <li class="breadcrumb-item"><a href="{{ route('editor.skills.index') }}">Skills</a></li>
                            <li class="breadcrumb-item active">Modules</li>
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
                                <h3 class="card-title">Modules</h3>
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
                                    <div class="col-lg-12">
                                        <div class="card mb-12">
                                            <div class="card-header">
                                                Modules
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if(1 == 2)
                                                        <p>There are no modules assigned for this skill.</p>
                                                    @else
                                                    <table class="table table-bordered table-hover" id="data_table_tb">
                                                        <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Module Name</th>
                                                            <th>View Details</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($data as $value)
                                                                <tr>
                                                                    <td>

                                                                        {{ $value->code }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $value->title }}
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('editor.module.details', $value->id) }}"
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
                                                    </table>@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Removed Card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
