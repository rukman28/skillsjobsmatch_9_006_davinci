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
                            <li class="breadcrumb-item"><a href="{{ route('editor.practicals.index') }}">Practicals</a></li>
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
                                <h3 class="card-title">Skills</h3>
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
                                            <a href="{{ route('editor.skill.new.view') }}" class="btn btn-success"
                                               style="margin: 0 10px;">Add New Skill</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="table-responsive">
                                        <form action="{{ route('editor.practical.store.skill') }}" method="post">
                                            @csrf
                                            <div class="row" style="padding-bottom: 10px;">
                                                <div class="col-md">
                                                    <div class="d-flex justify-content-lg-start ">
                                                        <button type="submit" class="btn btn-primary">Add Selected Modules</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <table class="table table-bordered table-hover" id="data_table_tb" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Skill</th>
                                                <th>Select</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($availableSkillToSelect as $skill)
                                                <tr>
                                                    <td>
                                                        {{ $skill->title }}
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="skill_ids[]" value="{{ $skill->id }}"
                                                                   id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                            <input type="hidden"
                                                   name="practical_id"
                                                   value="{{ $practical->id }}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
