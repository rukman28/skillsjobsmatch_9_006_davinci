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
                            <li class="breadcrumb-item active">Edit Skill</li>
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
                                <h3 class="card-title">Change Skill Details</h3>
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

                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Change the details</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form action="{{ route('editor.skill.update') }}" method="POST">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInput1">Skill Name</label>
                                                        <input type="text" class="form-control" id="exampleInput1" name="title" value="{{ $skill->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Select the skill category from the dropdown menu</label>
                                                        <select class="custom-select  rounded-1" id="exampleSelectBorder" name="skill_category_id">
                                                            @foreach($skillCategories as $cat)
                                                                <option value="{{ $cat->id }}" {{ ( $cat->id == $selected_category->id) ? 'selected' : '' }}>{{ $cat->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden"
                                                       name="skill_id"
                                                       value="{{ $skill->id }}"/>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card -->


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
