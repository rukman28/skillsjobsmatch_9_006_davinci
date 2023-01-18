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
                            <li class="breadcrumb-item active">Skills Categories</li>
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
                                <h3 class="card-title">Skills are categorised into the following categories.</h3>
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
                                            <a href="{{ route('editor.skill-categories.add.new.view') }}" class="btn btn-primary"
                                               style="margin: 0 10px;">Add New Category</a>
                                            <a href="{{ route('editor.skill-categories.show.bin') }}" class="btn btn-danger"
                                               onclick="return confirm('Please note that if you delete items from the bin, it cannot be recovered.')">Categories
                                                Bin</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="data_table_tb" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Skill Category</th>
                                                <th>Modify</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($skillCategories as $category)
                                                <tr>
                                                    <td>
                                                        {{ $category->title }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('editor.skill-category.details', $category->id) }}"
                                                           class="btn btn-primary btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-info"></i>
                                                            </span>
                                                            <span class="text">Skills</span>
                                                        </a>
                                                        <a href="{{ route('editor.skill-categories.show.practicals', $category->id) }}"
                                                           class="btn btn-secondary btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-info"></i>
                                                            </span>
                                                            <span class="text">Practicals</span>
                                                        </a>
                                                        <a href="{{ route('editor.skill-category.edit.view', $category->id) }}"
                                                           class="btn btn-success btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            <span class="text">Edit Name</span>
                                                        </a>
                                                        <a href="{{ route('editor.skill-category.remove', $category->id) }}"
                                                           onclick="return confirm('Are you sure?')"
                                                           class="btn btn-danger btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Delete</span>
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
@endsection
