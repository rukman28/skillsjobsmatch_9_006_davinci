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
                            <li class="breadcrumb-item active">Add New Skill</li>
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
                                <h3 class="card-title">Enter a new skill details.</h3>
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
                                                Add New Skill
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('editor.skill.store') }}" method="post">
                                                    <div class="form-group">
                                                        @csrf
                                                        <label for="title">Enter the Skill Title.</label>
                                                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="">
                                                        <input name="added_by" type="hidden" value="{{\Auth::user()->id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Select the skill category from the dropdown menu</label>
                                                        <select class="custom-select  rounded-1" id="exampleSelectBorder" name="skill_category_id">
                                                            @foreach($skillCategories as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add New Skill</button>
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
