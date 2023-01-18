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
                            <li class="breadcrumb-item"><a href="{{ route('editor.skill-categories.index') }}">Skills Categories</a></li>
                            <li class="breadcrumb-item active">Practicals</li>
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
                                <h3 class="card-title">Practicals for <b><i>{{ $skill_category->title }}</i></b></h3>
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
                                        <table class="table table-bordered table-hover" id="data_table_tb" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Practicals</th>
                                                <th>Details</th>
                                                <th>Modify</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($practical_collection as $practical)
                                                <tr>
                                                    <td>
                                                        {{ $practical->title }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-circle" href="{{ route('editor.practical.details', $practical->id ) }}"><i class="material-icons md-18">details</i></a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('editor.skill-categories.remove.practical') }}" method="post">
                                                            @csrf
                                                            <input type="hidden"
                                                                   name="practical_id"
                                                                   value="{{ $practical->id }}"/>
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="skillcategory_id" value="{{ $skill_category->id }}"/>
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
@endsection
