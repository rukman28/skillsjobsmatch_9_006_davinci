<?php
/*$students = DB::table('users')
    ->where('user_type', '=', 'user')
    ->orWhere('user_type', NULL)
    ->orWhere('user_type', '')
    ->get();*/

//$students = \App\Models\User::all()->except(Auth::id());
//$students = \App\Models\User::where('user_type', '!=', 'admin')->get();
//$students = \App\Models\User::whereNotIn('user_type', array('admin'))->get();
$students = \App\Models\User::role('user')->get();
$num_students = $students->count();

//Find the number of registered students without a module
$count = 0;
foreach ($students as $student) {
    if (!$student->modules()->count()) {
        $count++;
    }
}

$students_without_modules = $count;
$students_with_modules = $num_students - $count;


$total_programmes = \App\Models\Programme::all()->count();
$total_modules = \App\Models\Module::all()->count();
$total_practicals = \App\Models\Practical::all()->count();
$total_skills = \App\Models\Skill::all()->count();
$total_skill_categories = \App\Models\SkillCategory::all()->count();
$admin_last_login = auth()->user()->last_login_at;

$avg_studentsPerProgramme = round($num_students / $total_programmes, 2);
$avg_studentsPerModule = round($num_students / $total_modules, 2);

$avg_modulesPerProgramme = round($total_modules / $total_programmes, 2);
$avg_practicalsPerProgramme = round($total_practicals / $total_programmes, 2);
$avg_skillsPerProgramme = round($total_skills / $total_programmes, 2);

$avg_practicalsPerModule = round($total_practicals / $total_modules, 2);
$avg_skillsPerModule = round($total_skills / $total_modules, 2);

$avg_skillsPerPractical = round($total_skills / $total_practicals, 2);
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
                        <li class="breadcrumb-item"><a href="{{ route('editor.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_programmes }}</h3>

                            <p>Academic Courses</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="{{ route('editor.programme.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_modules }}</h3>

                            <p>Modules</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <a href="{{ route('editor.modules.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $num_students }}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('editor.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_skills }}</h3>

                            <p>Skills</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <a href="{{ route('editor.skills.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- Left col -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Table</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Users</td>
                                <td>{{ $num_students }}</td>
                            </tr>
                            <tr>
                                <td>Programmes</td>
                                <td>{{ $total_programmes }}</td>
                            </tr>
                            <tr>
                                <td>Modules</td>
                                <td>{{ $total_modules  }}</td>
                            </tr>
                            <tr>
                                <td>Practicals</td>
                                <td>{{ $total_practicals }}</td>
                            </tr>
                            <tr>
                                <td>Skill Categories</td>
                                <td>{{ $total_skill_categories  }}</td>
                            </tr>
                            <tr>
                                <td>Skills</td>
                                <td>{{ $total_skills }}</td>
                            </tr>
                            <tr>
                                <td>Average Students Per Programme</td>
                                <td>{{ $avg_studentsPerProgramme }}</td>
                            </tr>
                            <tr>
                                <td>Average Students Per Module</td>
                                <td>{{ $avg_studentsPerModule }}</td>
                            </tr>
                            <tr>
                                <td>Average Modules Per Programme</td>
                                <td>{{ $avg_modulesPerProgramme }}</td>
                            </tr>
                            <tr>
                                <td>Average Practicals Per Programme</td>
                                <td>{{ $avg_practicalsPerProgramme }}</td>
                            </tr>
                            <tr>
                                <td>Average Skills Per Programme</td>
                                <td>{{ $avg_skillsPerProgramme }}</td>
                            </tr>
                            <tr>
                                <td>Average Practicals Per Module</td>
                                <td>{{ $avg_practicalsPerModule }}</td>
                            </tr>
                            <tr>
                                <td>Average Skills Per Module</td>
                                <td>{{ $avg_skillsPerModule }}</td>
                            </tr>
                            <tr>
                                <td>Average Skills Per Practical</td>
                                <td>{{ $avg_skillsPerPractical }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
