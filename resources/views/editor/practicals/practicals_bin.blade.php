<?php
$i = 1
?>
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
                            <li class="breadcrumb-item"><a href="{{ route('editor.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Practicals Recycle Bin</li>
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
                                <h3 class="card-title">The following practicals are in the recycle bin.</h3>
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
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($practicals as $practical)
                                                <tr>
                                                    <td>
                                                        {{ $i++ }}
                                                    </td>
                                                    <td>
                                                        {{ $practical->title }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="row d-flex justify-content-around">
                                                            <a href="{{ route('editor.practical.force.delete', $practical->id) }}" class="btn btn-sm btn-danger"
                                                               role="button"><i class="faa-flash"></i>
                                                                Remove </a>

                                                            <a href="{{ route('editor.practical.restore', $practical->id) }}"
                                                               class="btn btn-sm btn-success"
                                                               role="button">
                                                                Restore </a>
                                                        </div>
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
