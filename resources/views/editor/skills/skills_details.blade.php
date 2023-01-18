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
                            <li class="breadcrumb-item active">Skill Details</li>
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
                                <h3 class="card-title">Skill Details</h3>
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
                                                <a href="{{ route('editor.skill.show.modules', $skill->id) }}" class="btn btn-primary"
                                                   style="margin: 10px;">View Modules Assigned For {{ $skill->title }}</a>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-12">
                                            <div class="card-header">
                                                Practicals for {{ $skill->title }}
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover" id="data_table_tb">
                                                        <thead>
                                                        <tr>
                                                            <th>Practical Name</th>
                                                            <th>Practical Details</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($practicals as $practical)
                                                            <tr>
                                                                <td>
                                                                    {{ $practical->title }}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success" href="{{ route('editor.practical.details', $practical->id ) }}">Show Details</a>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('editor.skill.remove.practical') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                               name="practical_id"
                                                                               value="{{ $practical->id }}"/>
                                                                        <input type="hidden"
                                                                               name="skill_id"
                                                                               value="{{ $skill->id }}"/>
                                                                        <input type="hidden" name="_method" value="DELETE" />
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
                                    <!-- Removed Card -->
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
                                <p>Skill Category <b>{{ $skill_category }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
